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
 * @author k 2017/10/23
 * @describe 发货处理
 */
class erpapi_shop_matrix_yunji_request_delivery extends erpapi_shop_request_delivery
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
        // 拆单子单回写
        $bn_list=array();
        if($sdf['is_split'] == 1&&$sdf['split_model']==1) {
            $param['is_split']  = $sdf['is_split'];
            foreach ($sdf['delivery_items'] as $arr){
                $bn_list[] = $arr['bn'];
            }
        }else{
            foreach ($sdf['order_items'] as $arr){
                $bn_list[] = $arr['bn'];
            }
        }
        $param['bn_list'] = json_encode($bn_list);
        return $param;
    }
}