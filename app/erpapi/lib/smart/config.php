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
 * smart接口配置类
 *
 * @author wangbiao@shopex.cn
 * @version 2024.04.22
 */
class erpapi_smart_config extends erpapi_config
{
    /**
     * 获取_query_params
     * @param mixed $method method
     * @param mixed $params 参数
     * @return mixed 返回结果
     */

    public function get_query_params($method, $params)
    {
        $query_params = array(
            'app_id' => 'ecos.ome',
            'method' => $method,
            'date' => date('Y-m-d H:i:s'),
            'format' => 'json',
            'v' => '1.1',
            'from_node_id' => base_shopnode::node_id('ome'),
            'to_node_id' => $this->__channelObj->smart['node_id'],
            'to_api_v' => $this->__channelObj->smart['api_version'],
            'node_type' => $this->__channelObj->smart['node_type'],
        );
        
        return $query_params;
    }
}