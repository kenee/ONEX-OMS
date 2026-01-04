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

class erpapi_store_openapi_pos_config extends erpapi_store_openapi_config
{
    
    
    
    /**
     * gen_sign
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function gen_sign($params)
    {
        $private_key = $this->__channelObj->store['config']['private_key'];
        $str = self::assemble($params);

        return hash_hmac('sha256', $str, $private_key);
        
    }

    /**
     * 获取_url
     * @param mixed $method method
     * @param mixed $params 参数
     * @param mixed $realtime realtime
     * @return mixed 返回结果
     */
    public function get_url($method, $params, $realtime){
        $url = $this->__channelObj->store['config']['api_url'];
        $url .= '/'.$method;
        return $url;

    }


    /**
     * format
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function format($params)
    {
        return json_encode($params,JSON_UNESCAPED_UNICODE);
    }


    /**
     * 获取_query_params
     * @param mixed $method method
     * @param mixed $params 参数
     * @return mixed 返回结果
     */
    public function get_query_params($method, $params)
    {
        $query_params = parent::get_query_params($method,$params);
        $query_params['headers'] = array(
            'Content-Type' => 'application/json',
        );

        return $query_params;
    }
}
