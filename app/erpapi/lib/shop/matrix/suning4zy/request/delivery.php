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
 * Class erpapi_shop_matrix_suning4zy_request_delivery
 */
class erpapi_shop_matrix_suning4zy_request_delivery extends erpapi_shop_request_delivery
{
    /**
     * 发货请求参数
     *
     * @return void
     * @author 
     **/
    protected function get_confirm_params($sdf)
    {
        $param = parent::get_confirm_params($sdf);

        $item_list = array();
        foreach ($sdf['orderinfo']['order_objects'] as $object) {

            if ($object['oid']) $item_list[] = $object['oid'];
        }

        $param['item_list'] = json_encode($item_list);
        
        return $param;
    }
}