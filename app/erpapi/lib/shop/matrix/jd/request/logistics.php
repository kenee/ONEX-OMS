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

class erpapi_shop_matrix_jd_request_logistics extends erpapi_shop_request_logistics
{
    /**
     * 获取CarrierPlatform
     * @param mixed $sdf sdf
     * @return mixed 返回结果
     */
    public function getCarrierPlatform($sdf)
    {
        $title = '平台承运商履约信息查询';
        $params = ['orderId' => $sdf['order_bn'], 'shippingMethod' => $sdf['shippingMethod']];
        $result = $this->__caller->call(SHOP_JDGXD_LOGISTICS_FULFILLMENT_INFO, $params, [], $title, 10, $sdf['order_bn']);
        return $result;
    }
    
}