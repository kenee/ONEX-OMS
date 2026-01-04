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
 * @author ykm 2016-01-20
 * @describe 短信平台返回数据预处理
 */
class erpapi_sms_result extends erpapi_result {

    function set_response($response, $format)
    {
        $response = kernel::single('erpapi_format_'.$format)->data_decode($response);
        
        $rsp['rsp'] = $response['res'] == 'succ' ? 'succ' : 'fail';
        $rsp['res'] = $response['code'] ? $response['code'] : $response['msg'];
        $rsp['data'] = $response['info'] ? $response['info'] : $response['data'];
        $this->response = $rsp;
        return $this;
    }
}