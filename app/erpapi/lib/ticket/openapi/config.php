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

class erpapi_ticket_openapi_config extends erpapi_ticket_config
{
    /**
     * 应用级参数
     *
     * @param String $method 请求方法
     * @param Array $params 业务级请求参数
     * @return void
     * @author 
     **/
    public function get_query_params($method, $params){
        // 各自实现
        $query_params = array(
          
        );

        return $query_params;
    }

    public function gen_sign($params)
    {
        $private_key = $this->__channelObj->channel['config']['private_key'];
        $str = self::assemble($params);
        return hash_hmac('sha256', $str, $private_key);
    }

    public function get_url($method, $params, $realtime){
        $url = $this->__channelObj->channel['config']['api_url'];

        return $url;
    }
    
}
