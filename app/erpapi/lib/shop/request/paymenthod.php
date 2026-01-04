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

class erpapi_shop_request_paymenthod extends erpapi_shop_request_abstract
{
    /**
     * 获取paymethod
     * @return mixed 返回结果
     */
    public function getpaymethod(){}

    /**
     * 获取_paymethod_callback
     * @param mixed $response response
     * @param mixed $callback_params 参数
     * @return mixed 返回结果
     */
    public function get_paymethod_callback($response, $callback_params){}    
}