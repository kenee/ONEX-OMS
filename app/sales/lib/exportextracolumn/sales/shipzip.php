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
 * 销售单导出扩展收货地址字段
 * @author xiayuanjun@shopex.cn
 * @version 1.0
 */
class sales_exportextracolumn_sales_shipzip extends sales_exportextracolumn_abstract implements sales_exportextracolumn_interface{

    protected $__pkey = 'order_id';

    protected $__extra_column = 'column_ship_zip';

    /**
     *
     * 获取订单相关的优惠方案
     * @param $ids
     * @return array $tmp_array关联数据数组
     */
    public function associatedData($ids){
        //根据订单ids获取相应的优惠方案
        $orderObj = app::get('ome')->model('orders');
        $shipzip_lists = $orderObj->db->select('select ship_zip,'.$this->__pkey.' from  sdb_ome_orders where order_id in ('.implode(',',$ids).')');

        $tmp_array= array();
        foreach($shipzip_lists as $k=>$row){
            $tmp_array[$row[$this->__pkey]] = $row['ship_zip'];
        }
        unset($shipzip_lists);
        $archive_ordObj = kernel::single('archive_interface_orders');
        $archiveshipzip_lists=$archive_ordObj->getOrder_list(array('order_id'=>$ids),'order_id,ship_zip');
        foreach($archiveshipzip_lists as $k=>$row){
            $tmp_array[$row[$this->__pkey]] = $row['ship_zip'];
        }
        unset($archiveshipzip_lists);
        return $tmp_array;
    }

}