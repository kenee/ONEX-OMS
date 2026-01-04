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
 * @author ykm 2018/04/25
 * @describe 发货处理
 */

class erpapi_shop_matrix_gegejia_request_delivery extends erpapi_shop_request_delivery
{

    protected function get_confirm_params($sdf)
    {
        $param = parent::get_confirm_params($sdf);
        $skuList = array();
        foreach($sdf['orderinfo']['order_objects'] as $value) {
            $skuList[] = array(
                'bn' => $value['shop_goods_id'] != -1 ? $value['shop_goods_id'] : $value['bn'],
                'quantity' => $value['quantity']
            );
        }
        $param['skuList'] = json_encode($skuList);
        return $param;
    }
}