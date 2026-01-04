<?php
/**
 * Copyright 2026 ShopeX (https://www.shopex.cn)
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
 * 门店发货单的扩展字段订单号
 * @author xiayuanjun@shopex.cn
 * @version 1.0
 */
class o2o_extracolumn_order_bns extends desktop_extracolumn_abstract implements desktop_extracolumn_interface{

    protected $__pkey = 'delivery_id';

    protected $__extra_column = 'column_order_bns';

    /**
     *
     * 获取发货单相关的订单号信息
     * @param $ids
     * @return array $tmp_array关联数据数组
     */
    public function associatedData($ids){
        //根据发货单ids获取相应的备注信息
        $dlyOrderObj = app::get('ome')->model('delivery_order');
        $orders = $dlyOrderObj->db->select('select o.order_bn,'.$this->__pkey.' from  sdb_ome_delivery_order AS do LEFT JOIN sdb_ome_orders AS o ON do.order_id = o.order_id where do.delivery_id in ('.implode(',',$ids).')');

        $order_bns = array();
        foreach($orders as $order){
            $order_bns[$order[$this->__pkey]][] = $order['order_bn'];
            
        }

        $tmp_array= array();
        foreach($order_bns as $k=>$val){
             $tmp_array[$k] = implode('、',$val);
        }
        return $tmp_array;
    }

}