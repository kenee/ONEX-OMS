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

class erpapi_logistics_matrix_meituan4bulkpurchasing_config extends erpapi_logistics_matrix_config{

    /**
     * 获取_query_params
     * @param mixed $method method
     * @param mixed $params 参数
     * @return mixed 返回结果
     */
    public function get_query_params($method, $params){
        $shopId = $this->__channelObj->channel['shop_id'];
        $shop = app::get('ome')->model('shop')->dump(array('shop_id'=>$shopId), 'node_type,node_id');
        $query_params = array(
            'to_node_id' => $shop['node_id'],
            'node_type' => $shop['node_type'],
        );
        if($method == STORE_USER_TEMPLATE) {
            unset($query_params['company_code']);
        }
        $pqp = parent::get_query_params($method, $params);
        $query_params = array_merge($pqp, $query_params);
        return $query_params;
    }

    /**
     * 获取_to_node_id
     * @return mixed 返回结果
     */
    public function get_to_node_id()
    {
        $shopId = $this->__channelObj->channel['shop_id'];
        $shop = app::get('ome')->model('shop')->dump(array('shop_id'=>$shopId), 'node_id');

        return $shop['node_id'];
    }
}