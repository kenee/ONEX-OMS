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
 * 基础接口相关
 *
 * @categoryclassName
 * @package
 * @version $Id: Z
 */
class erpapi_shop_matrix_website_d1m_request_base extends erpapi_shop_request_abstract
{
    /**
     * 获取token
     * @param $appid
     * @param $secret
     * @return mixed
     */

    public function get_access_token($refresh = true)
    {
        $tokenKey = "d1m_access_token";
        base_kvstore::instance('d1m/api')->fetch($tokenKey, $token);
        if ($token && !$refresh) {
            return $token;
        }
        
        $rs = $this->__caller->call(D1M_ACCESS_TOKEN_POST, [], array(), 'D1M获取accessToken', 10, 'd1m_token');
    
        if ($rs['rsp'] == 'succ') {
            base_kvstore::instance('d1m/api')->store($tokenKey, $rs['data']['token'], 3000);
            base_kvstore::instance('d1m/api')->fetch($tokenKey, $token);
            return $token;
        } else {
            return false;
        }
    }
}