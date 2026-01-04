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
 * Created by PhpStorm.
 * User: gehuachun
 * Date: 2018/11/20
 * Time: 11:18 AM
 */

class ome_event_trigger_shop_data_delivery_weimobv extends ome_event_trigger_shop_data_delivery_common
{
    /**
     * @param Int $delivery_id
     * @return array|void
     */
    public function get_sdf($delivery_id)
    {
        $this->__sdf = parent::get_sdf($delivery_id);
        if ($this->__sdf) {
            $this->__sdf['split_model'] = $this->_is_split_switch($delivery_id);
            $this->_get_order_objects_sdf($delivery_id);
            $this->_get_delivery_items_sdf($delivery_id);
            $this->_get_split_sdf($delivery_id);
        }
        return $this->__sdf;
    }
}