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
 * 销售单导出扩展发货单号字段
 * @author xiayuanjun@shopex.cn
 * @version 1.0
 */
class sales_exportextracolumn_sales_deliverybn extends sales_exportextracolumn_abstract implements sales_exportextracolumn_interface{

    protected $__pkey = 'sale_id';

    protected $__extra_column = 'column_delivery_bn';

    /**
     *
     * 获取订单相关的优惠方案
     * @param $ids
     * @return array $tmp_array关联数据数组
     */
    public function associatedData($ids){
        $salesObj = app::get('sales')->model('sales');
        $sales_arr = $salesObj->db->select('select delivery_id,'.$this->__pkey.' from  sdb_ome_sales where sale_id in ('.implode(',',$ids).')');
        foreach($sales_arr as $k => $sales){
            $dly_ids[] = $sales['delivery_id'];
            $sales_dly_ids[$sales[$this->__pkey]] = $sales['delivery_id'];
        }

        $deliveryObj = app::get('ome')->model('delivery');
        $deliverybn_lists = $deliveryObj->db->select('select delivery_bn,delivery_id from  sdb_ome_delivery where delivery_id in ('.implode(',',$dly_ids).')');
        foreach($deliverybn_lists as $k=>$row){
            $dly_ids_bns[$row['delivery_id']] = $row['delivery_bn']; 
        }

        $tmp_array= array();
        foreach($sales_dly_ids as $k => $val){
            if(isset($dly_ids_bns[$val])){
                $tmp_array[$k] = $dly_ids_bns[$val];
            }
        }

        return $tmp_array;
    }

}