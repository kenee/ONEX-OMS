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

class ome_exportextracolumn_gift_paytime extends ome_exportextracolumn_abstract implements ome_exportextracolumn_interface{

    protected $__pkey = 'order_id';

    protected $__extra_column = 'column_paytime';

    public function associatedData($ids){
        $mdl_ome_orders = app::get('ome')->model('orders');
        $orderData = $mdl_ome_orders->getList("order_id,paytime",array("order_id"=>$ids));
        $tmp_array = array();
        foreach ($orderData as $key => $row){
            $tmp_array[$row[$this->__pkey]] = date("Y-m-d H:i:s",$row["paytime"]);
        }
        return $tmp_array;
    }
    
}