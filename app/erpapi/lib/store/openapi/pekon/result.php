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

class erpapi_store_openapi_pekon_result extends erpapi_result
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

        if((int)$this->responseHttpCode != 200){
            $rsp = 'fail';
        }else{
            if($response['code'] == '10000'){
                $rsp = 'succ';
            }else{
                $rsp = 'fail';
            }
        }
        $this->response = [
            'msg_id'  => $response['catId'],
            'rsp'     => $rsp,
            'data'    => $response['data'],
            'res'     => '',
            'err_msg' => $response['message'],
        ];

        if ($response['code'] == '10000' && $response['data']) {
            $this->response['data'] = $response['data'];
        }

        return $this;
    }

}
