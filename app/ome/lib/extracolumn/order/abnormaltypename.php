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
 * 订单的扩展字段异常类型名称
 * @author xiayuanjun@shopex.cn
 * @version 1.0
 */
class ome_extracolumn_order_abnormaltypename extends ome_extracolumn_abstract implements ome_extracolumn_interface{

    protected $__pkey = 'order_id';

    protected $__extra_column = 'column_abnormal_type_name';

    /**
     *
     * 获取订单相关的异常类型名称
     * @param $ids
     * @return array $tmp_array关联数据数组
     */
    public function associatedData($ids){
        if(empty($ids)) return array();
        //根据发货单ids获取相应的备注信息
        $deliveryObj = app::get('ome')->model('orders');
        $abtpName_lists = $deliveryObj->db->select('select abnormal_type_name,'.$this->__pkey.' from  sdb_ome_abnormal where order_id in ('.implode(',',$ids).')');

        $tmp_array= array();
        foreach($abtpName_lists as $k=>$row){
             $tmp_array[$row[$this->__pkey]] = $row['abnormal_type_name'];
        }
        return $tmp_array;
    }

}