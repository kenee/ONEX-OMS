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
 * @author sunjing@shopex.cn
 * @describe 发货处理
 */

class erpapi_shop_matrix_yangsc_request_delivery extends erpapi_shop_request_delivery
{

    protected function get_confirm_params($sdf)
    {

        // 货号对应平台商品ID
        $logistics_list = array();
        foreach ((array) $sdf['delivery_items'] as $item) {
            if ($item['shop_goods_id'] && $item['shop_goods_id'] != '-1') {
                $logistics_list[] = array(
                    'shop_goods_id' => $item['shop_goods_id'],
                    'company_code'  => $sdf['logi_type'], // 物流编号
                    'logistics_no'  => $sdf['logi_no'], // 运单号
                    'num'           => $item['number'],
                );
            }
        }

        $param = array(
            'tid'          => $sdf['orderinfo']['order_bn'], // 订单号
            'logistics_list' => json_encode($logistics_list)
        );
        
  
        return $param;
    }
}