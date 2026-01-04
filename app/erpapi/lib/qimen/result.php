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
 * 格式化请求响应结果Lib类
 */
class erpapi_qimen_result extends erpapi_result
{
    /**
     * 设置_response
     *
     * @param mixed $response response
     * @param mixed $format format
     * @return mixed 返回操作结果
     */
    public function set_response($response, $format)
    {
        $format = $format ? $format : 'json';
        $response = kernel::single('erpapi_format_' . $format)->data_decode($response);
        if($response){
            if(isset($response['response'])){
                $response = $response['response'];
            }
        }
        
        // 响应结果
        $rsp = ($response['flag'] == 'success' ? 'succ' : 'fail');
        
        // data
        $orderData = [];
        if($rsp == 'succ' && isset($response['trade_orders'])){
            $orderData = $response['trade_orders'];
        }
        
        $this->response = [
            'rsp'      => $rsp,
            'res'      => ($response['code'] ? $response['code'] : $response['sub_code']),
            'err_msg'  => $response['message'],
            'err_code' => $response['code'],
            'msg_id'   => $response['request_id'],
            'data'     => json_encode($orderData, JSON_UNESCAPED_UNICODE),
        ];
        
        return $this;
    }
}