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

class erpapi_shop_matrix_pos_dms_request_delivery extends erpapi_shop_matrix_pos_request_delivery
{
    protected function get_confirm_params($sdf)
    {
        $param = array(
            'tid'         => $sdf['orderinfo']['order_bn'], // 订单号
            'logi_code'   => $sdf['logi_type'], // 物流编号
            'logi_name'   => $sdf['logi_name'], // 物流公司
            'logi_no'     => $sdf['logi_no'], // 运单号
            // 'store_code'  => '',
            't_confirm'   => date('Y-m-d H:i:s', $sdf['delivery_time']),
            'delivery_bn' => $sdf['delivery_bn'],
            'method'      => 'b2c.delivery.update',
        );

        $items = [];
        foreach ($sdf['delivery_items'] as $k => $v) {
            $items[] = array(
                'product_bn'   => $v['bn'],
                'product_name' => $v['name'],
                'number'       => $v['number'],
            );
        }
        $param['items'] = json_encode($items);

        return $param;
    }
}
