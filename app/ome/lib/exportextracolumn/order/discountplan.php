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
 * 订单导出扩展字段优惠方案
 * @author xiayuanjun@shopex.cn
 * @version 1.0
 */
class ome_exportextracolumn_order_discountplan extends ome_exportextracolumn_abstract implements ome_exportextracolumn_interface{

    protected $__pkey = 'order_id';

    protected $__extra_column = 'column_discount_plan';

    /**
     *
     * 获取订单相关的优惠方案
     * @param $ids
     * @return array $tmp_array关联数据数组
     */
    public function associatedData($ids){
        //根据订单ids获取相应的优惠方案
        $orderPmtObj = app::get('ome')->model('order_pmt');
        $discountplan_lists = $orderPmtObj->db->select('select pmt_describe,pmt_amount,'.$this->__pkey.' from  sdb_ome_order_pmt where order_id in ('.implode(',',$ids).')');

        $tmp_array= array();
        foreach($discountplan_lists as $k=>$row){
             if(isset($tmp_array[$row[$this->__pkey]])){
                $tmp_array[$row[$this->__pkey]] .= $row['pmt_describe'].":优惠金额:".$row['pmt_amount'].";";
             }else{
                $tmp_array[$row[$this->__pkey]] = $row['pmt_describe'].":优惠金额:".$row['pmt_amount'].";";
             }
        }
        return $tmp_array;
    }

}