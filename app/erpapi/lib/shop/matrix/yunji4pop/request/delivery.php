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
 * @Author: xueding@shopex.cn
 * @Datetime: 2022/3/3
 */
class erpapi_shop_matrix_yunji4pop_request_delivery extends erpapi_shop_request_delivery
{
    /**
     * 发货请求参数
     * 
     * @return void
     * @author
     * */

    protected function get_confirm_params($sdf)
    {
        $param     = parent::get_confirm_params($sdf);
        $item_list = array();
        foreach ($sdf['delivery_items'] as $item) {
            $arr                 = array();
            $arr['oid']          = $item['oid'];
            $arr['bn']           = $item['bn'];
            $arr['bar_code']     = $item['shop_goods_id'];
            $arr['num']          = $item['number'];
            $arr['company_code'] = $param['company_code'];
            $arr['logistics_no'] = $param['logistics_no'];
            
            $item_list[$item['oid']] = $arr;
        }
        $param['logistics_list'] = json_encode(array_values($item_list));
        return $param;
    }
    
        /**
     * confirm_callback
     * @param mixed $response response
     * @param mixed $callback_params 参数
     * @return mixed 返回值
     */
    public function confirm_callback($response, $callback_params)
    {
        if ($response['data'] && $response['rsp'] == 'fail') {
            $data = json_decode($response['data'], 1);
            if ($data['results']) {
                $rsp = 'succ';
                foreach ($data['results'] as $val) {
                    if (!strpos($val['message'], '已经发货')) {
                        $rsp = 'fail';
                    }
                }
                $response['rsp'] = $rsp;
            }
        }
        return parent::confirm_callback($response, $callback_params);
    }
    
    
}