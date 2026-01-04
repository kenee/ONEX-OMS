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

class o2o_operation_log{
        function get_operations(){
           $operations = array(
             'inventory_cancel' => array('name'=> '门店盘点单作废','type' => 'inventory@o2o'),
             'inventory_edit' => array('name'=> '门店盘点单编辑','type' => 'inventory@o2o'),
             'inventory_confirm' => array('name'=> '门店盘点单确认','type' => 'inventory@o2o'),
             'delivery' => array('name'=> '单据操作','type' => 'delivery@o2o'),
             'delivery_expre' => array('name'=> '快递单打印','type' => 'delivery@o2o'),
             'delivery_deliv' => array('name'=> '发货单打印','type' => 'delivery@o2o'),
             'store_upsert'      => array('name' => '门店信息维护', 'type' => 'store@o2o'),
            'storage_upsert'    => array('name' => '门店仓位维护', 'type' => 'store@o2o'),
        );
        return array('o2o'=>$operations);
     }
}
?>