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
 * 发货单处理
 */
class erpapi_shop_matrix_meituan4bulkpurchasing_request_delivery extends erpapi_shop_request_delivery
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
        $param['package_type'] = 'normal';
        // 拆单回写
        if ($sdf['is_split']) {
            $param['package_type'] = 'break';
            $packages              = array();
            $goods = [];
            foreach ($sdf['delivery_items'] as $key => $value) {
                if(!$value['oid']) {
                    continue;
                }
                $goods[] = [
                    'comp_item_id' => $value['shop_goods_id'],
                    'comp_sku_id' => $value['oid'],
                ];
            }
            $packages[] = [
                'logistics_no' => $value['logi_no'],
                'company_code' => $value['logi_type'],
                'package_id' => $sdf['delivery_bn'],
                'goods' => $goods
            ];
            $param['packages'] = json_encode($packages);
        }
        return $param;
    }
}