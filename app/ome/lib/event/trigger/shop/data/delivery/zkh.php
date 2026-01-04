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
 * 获取数据
 * Class ome_event_trigger_shop_data_delivery_zkh
 */
class ome_event_trigger_shop_data_delivery_zkh extends ome_event_trigger_shop_data_delivery_common
{
    public function get_sdf($delivery_id)
    {
        $this->__sdf = parent::get_sdf($delivery_id);
        if ($this->__sdf) {
            $this->_get_delivery_items_sdf($delivery_id);
//            $this->_get_order_objects_sdf($delivery_id);
            $this->_get_split_sdf($delivery_id);
            $this->__sdf['branch'] = $this->_get_branch($this->__deliverys[$delivery_id]['branch_id']);
    
            $order = $this->__sdf['orderinfo'];
            //获取所有包裹
            $orderDelivery = app::get('ome')->model('delivery')->getAllDeliversOrderId($order['order_id']);
            $delivery_package = [];
            foreach($orderDelivery as $value){
                $package = $this->_get_delivery_package($value['delivery_id']);
                $delivery_package    = array_merge($delivery_package,(array)$package);
            }
            $this->__sdf['delivery_package'] = $delivery_package;
        }
        
        return $this->__sdf;
    }
}
