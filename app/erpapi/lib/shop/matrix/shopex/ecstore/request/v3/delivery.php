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

class erpapi_shop_matrix_shopex_ecstore_request_v3_delivery extends erpapi_shop_request_delivery
{


    protected function get_delivery_apiname($sdf)
    {
        $api_name = SHOP_LOGISTICS_OFFLINE_SEND;

        return $api_name;
    }




    protected function format_confirm_sdf(&$sdf)
    {
        parent::format_confirm_sdf($sdf);
    }

    /**
     * 发货请求参数
     *
     * @return void
     * @author
     **/
    protected function get_confirm_params($sdf)
    {

        $param = parent::get_confirm_params($sdf);

        // 拆单子单回写
        if($sdf['is_split'] == 1) {
            $param['is_split']  = $sdf['is_split'];
            $param['oid_list']  = json_encode($sdf['oid_numlist']);
        }

        $param['delivery_cost_actual'] = $sdf['delivery_cost_actual'];
        return $param;
    }
}