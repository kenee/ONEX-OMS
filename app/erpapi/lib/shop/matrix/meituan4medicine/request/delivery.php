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
class erpapi_shop_matrix_meituan4medicine_request_delivery extends erpapi_shop_request_delivery
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
        
        // 拆单回写
        if ($sdf['is_split'] && $sdf['orderinfo']['ship_status'] == '1') {
            $param                 = array();
            $param['package_type'] = 'break';
            $param['tid']          = $sdf['orderinfo']['order_bn'];
            $packages              = array();
            $num = 0;
            foreach ($sdf['delivery_items'] as $key => $value) {
                if ($num >= 5) {
                    continue;
                }
                $packages[] = [
                    'logistics_no' => $value['logi_no'],
                    'company_code' => $value['logi_type'],
                    'company_name' => $value['logi_name'],
                ];
                $num++;
            }
            $param['packages'] = json_encode($packages);
        }
        //如果快递公司是顺丰必须传递手机号
        $param['recipient_phone'] = $sdf['consignee']['mobile'];
        return $param;
    }
}