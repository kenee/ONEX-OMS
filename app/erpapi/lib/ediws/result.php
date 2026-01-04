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
class erpapi_ediws_result extends erpapi_result
{
    /**
     * 设置_response
     * @param mixed $response response
     * @param mixed $format format
     * @return mixed 返回操作结果
     */

    public function set_response($response, $format)
    {

        $response = kernel::single('erpapi_format_' . $format)->data_decode($response);


        $messageCode = trim($response['success']);
        
        if($messageCode == true){
            $rsp = 'succ';
        }else{
            $rsp = 'fail';
        }

        if($rsp=='fail' && $response['code']==200 && $response['data']){
            $rsp = 'succ';
        }
        $response['message'] = ($response['Message'] ? $response['Message'] : $response['message']);
        $this->response = [
            'rsp'     => $rsp,
            'data'    => $response,
            'res'     => '',
            'err_msg' => $response['message'],
            'err_code'=>$response['responseCode'],
        ];

      
        return $this;
    }
}