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

class erpapi_logistics_matrix_jdgxd_config extends erpapi_logistics_matrix_config
{
    /**
     * 获取_query_params
     * @param mixed $method method
     * @param mixed $params 参数
     * @return mixed 返回结果
     */
    public function get_query_params($method, $params)
    {
        $jdgxd        = explode('|||', $this->__channelObj->channel['shop_id']);
        $shop         = app::get('ome')->model('shop')->dump(array('shop_id' => $jdgxd[0]), 'node_type,node_id');
        $query_params = array(
            'cp_code'    => $this->__channelObj->channel['logistics_code'],
            'to_node_id' => $shop['node_id'],
            'node_type'  => $shop['node_type'],
        );
        
        $pqp          = parent::get_query_params($method, $params);
        $query_params = array_merge($pqp, $query_params);
        return $query_params;
    }
}