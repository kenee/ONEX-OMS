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

class purchase_operation_log{
	    
    /**
     * 定义当前APP下的操作日志的所有操作名称列表
     * type键值由表名@APP名称组成
     * @access public
     * @return Array
     */
    function get_operations(){
        $operations = array(
           'purchase_create' => array('name'=> '生成采购单','type' => 'po@purchase'),
           'purchase_modify' => array('name'=> '修改采购单','type' => 'po@purchase'),
           'purchase_cancel' => array('name'=> '采购单入库取消','type' => 'po@purchase'),
           'purchase_storage' => array('name'=> '采购入库','type' => 'po@purchase'),
           'purchase_refund' => array('name'=> '采购退款','type' => 'purchase_refunds@purchase'),
           'purchase_delete' => array('name'=> '删除采购单','type' => 'po@purchase'),
           'purchase_shiftdelete' => array('name'=> '彻底删除采购单','type' => 'po@purchase'),
           'purchase_restore' => array('name'=> '恢复被删除的采购单','type' => 'po@purchase'),
           'purchase_supplier_del' => array('name'=> '删除供应商','type' => 'supplier@purchase'),
          'purchase_order_wait' => array('name'=> '待寻仓订单','type' => 'order_wait@purchase'),
        );
        
        return array('purchase'=>$operations);
    }
}
?>