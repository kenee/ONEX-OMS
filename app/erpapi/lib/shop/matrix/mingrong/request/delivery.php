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
 * @author ykm 2019/2/15
 * @describe 名融 发货处理
 */

class erpapi_shop_matrix_mingrong_request_delivery extends erpapi_shop_request_delivery
{
    protected function get_confirm_params(&$sdf)
    {
        $param = parent::get_confirm_params($sdf);
        $param['is_split'] = $sdf['is_split'];
        $product_list = array();
        foreach($sdf['delivery_items'] as $k => $item){
            $product_list[] = array(
                'bn' => $item['bn'],
                'num' => $item['number'],
            );
        }

        $param['sku_info'] = json_encode($product_list);

        return $param;
    }


}