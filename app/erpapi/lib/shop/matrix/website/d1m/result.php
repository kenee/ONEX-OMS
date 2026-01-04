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

class erpapi_shop_matrix_website_d1m_result extends erpapi_result {
    
    protected $_retryErrorMsgList = [
        'Unable to authenticate user.',
    ];
    
    function set_response($response, $format)
    {
        parent::set_response($response, $format);
        if($this->response['rsp'] == 'error'){
            $this->response['rsp'] = 'fail';
        }
        if($this->response['res'] == 'succ'){
            $this->response['rsp'] = 'succ';
        }
        
        if($this->response['rsp'] == 'fail'){
            $this->response['err_msg'] = $this->response['msg'];
        }
    
        if ($this->response['data'] && $this->response['data']['res'] == 'error') {
            $this->response['rsp']     = 'fail';
            $this->response['err_msg'] = $this->response['data']['error_message'];
        }
    
        if ($this->response['data'] && $this->response['data']['res'] == 'succ') {
            $this->response['rsp']     = 'succ';
        }
        
        if($this->response['data'] && $this->response['data']['status'] == 200){
            $this->response['rsp'] = 'succ';
        }
    }
    
    /**
     * token失效标识
     * @return string[]
     * @author db
     * @date 2023-05-22 6:35 下午
     */
    function retryErrorMsgList()
    {
        return $this->_retryErrorMsgList;
    }
}
