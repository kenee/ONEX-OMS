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
 * 订单导出扩展字段订单备注图标颜色
 * @author liuzecheng@shopex.cn
 * @version 1.0
 */
class ome_exportextracolumn_order_marktypecolour extends ome_exportextracolumn_abstract implements ome_exportextracolumn_interface{

    protected $__pkey = 'order_id';

    protected $__extra_column = 'column_mark_type_colour';

    /**
     *
     * 获取订单备注图标颜色
     * @param $ids
     * @return array $tmp_array关联数据数组
     */
    public function associatedData($ids){
        $mark_type = array('b0'=>'灰色','b1'=>'红色','b2'=>'橙色','b3'=>'黄色','b4'=>'蓝色','b5'=>'紫色','b6'=>'粉红色','b7'=>'绿色',''=>'-');
        //根据订单ids获取相应的订单备注图标
        $orderPmtObj = app::get('ome')->model('orders');
        $marktype_lists = $orderPmtObj->db->select('select mark_type,'.$this->__pkey.' from  sdb_ome_orders where order_id in ('.implode(',',$ids).')');

        $tmp_array= array();
        foreach($marktype_lists as $k=>$row){
             if(isset($tmp_array[$row[$this->__pkey]])){
                $tmp_array[$row[$this->__pkey]] .= $mark_type[$row['mark_type']].";";
             }else{
                $tmp_array[$row[$this->__pkey]] = $mark_type[$row['mark_type']].";";
             }
        }
        return $tmp_array;
    }

}