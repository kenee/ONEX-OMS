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
 * @author ykm 2022/6/28 17:28:44
 * @describe 订单接收回调
 */
class erpapi_shop_response_plugins_order_received extends erpapi_shop_response_plugins_order_abstract
{
    /**
     * convert
     * @param erpapi_shop_response_abstract $platform platform
     * @return mixed 返回值
     */

    public function convert(erpapi_shop_response_abstract $platform)
    {
        $ordersdf                    = $platform->_ordersdf;
        $sdf = [];
        if($ordersdf['order_source'] == 'maochao') {
            $sdf['received'] = true;
        }
        
        return $sdf;
    }

    /**
     * 订单完成后处理
     **/
    public function postCreate($order_id, $sdf)
    {
        if($sdf['received']) {
            kernel::single('ome_event_trigger_shop_order')->received($order_id);
        }
    }

    /**
     * 更新后操作
     *
     * @return void
     * @author
     **/
    public function postUpdate($order_id, $sdf)
    {
       
    }
}
