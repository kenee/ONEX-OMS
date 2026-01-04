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

class erpapi_shop_matrix_pos_dms_config extends erpapi_shop_matrix_pos_config
{
    /**
     * gen_sign
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function gen_sign($params)
    {
        //暂时往前端打
        $node_type = $this->__channelObj->channel['node_type'];
        $servers   = $this->getServer($node_type);

        unset($params['callback_url'],$params['task']);

        $private_key = $servers['config']['private_key'];

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
    public function get_url($method, $params, $realtime)
    {
        $node_type = $this->__channelObj->channel['node_type'];

        $servers = $this->getServer($node_type);

        $url = $servers['config']['api_url'];

        switch ($method) {
            case 'store.logistics.offline.send':
                $url .= 'api/inventory/oms/saveLogiInfo';
                break;
        }

        return $url;
    }

    private function getServer($node_type)
    {

        $serverObj = app::get('o2o')->model('server');
        $store     = $serverObj->dump(array('node_type' => $node_type), 'config');

        if (!$store) {
            return false;
        }
        $store['config'] = @unserialize($store['config']);

        return $store;
    }

    /**
     * format
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function format($params)
    {
        unset($params['callback_url'],$params['task']);

        return json_encode($params, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 获取_query_params
     * @param mixed $method method
     * @param mixed $params 参数
     * @return mixed 返回结果
     */
    public function get_query_params($method, $params)
    {
        return [
            'date'    => date('Y-m-d H:i:s'),
            'node_id' => $this->__channelObj->channel['node_id'],
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ];
    }
}
