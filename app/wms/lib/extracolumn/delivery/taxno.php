<?php
/**
 * Copyright 2012-2026 ShopeX (https://www.shopex.cn)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * 发货单的扩展字段发票头
 * @author xiayuanjun@shopex.cn
 * @version 1.0
 */
class wms_extracolumn_delivery_taxno extends wms_extracolumn_abstract implements wms_extracolumn_interface{

    protected $__pkey = 'delivery_id';

    protected $__extra_column = 'column_tax_no';

    /**
     *
     * 获取发货单相关订单的客服备注
     * @param $ids
     * @return array $tmp_array关联数据数组
     */
    public function associatedData($ids){
        if(empty($ids)) {
            return array();
        }
        //根据发货单ids获取相应的备注信息
        $deliveryObj = app::get('ome')->model('delivery');
        $sql ='select ome.delivery_id, wms.delivery_id AS wms_delivery_id from sdb_ome_delivery AS ome left join sdb_wms_delivery AS wms on ome.delivery_bn=wms.outer_delivery_bn where wms.delivery_id in('.implode(',',$ids).')';
        $temp = $deliveryObj->db->select($sql);
        foreach ($temp as $key => $val){
            $temp_data[$val['delivery_id']] = array('delivery_id'=>$val['delivery_id'], 'wms_delivery_id'=>$val['wms_delivery_id']);
            $outer_ids[] = $val['delivery_id'];
        }

        $sql1 = 'SELECT DO.'.$this->__pkey.',O.tax_no FROM sdb_ome_orders AS O LEFT JOIN 
            sdb_ome_delivery_order AS DO ON DO.order_id=O.order_id WHERE DO.delivery_id in ('.implode(',',$outer_ids).')';
        $orders = $deliveryObj->db->select($sql1);
        $tax_no = array();
        $tmp_array = array();
        foreach($orders as $order){
            $wms_delivery_id = $temp_data[$order[$this->__pkey]]['wms_delivery_id'];
            $tax_no[$wms_delivery_id][] = $order['tax_no'];
            
        }

        foreach($tax_no as $k =>$val){
            $tmp_array[$k] = '<span title="'.implode('、',$val).'">'.implode('、',$val).'</span>';
        }
        return $tmp_array;
    }

}