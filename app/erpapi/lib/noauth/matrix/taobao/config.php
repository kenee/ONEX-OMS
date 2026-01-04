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
 * CONFIG
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_noauth_matrix_taobao_config extends erpapi_noauth_config
{
    /**
     * 应用级参数(借用CC的配置)
     *
     * @param String $method 请求方法
     * @param Array $params 业务级请求参数
     * @return void
     * @author 
     **/

    public function get_query_params($method, $params){
        $query_params = array(
            'app_id'       => 'ecos.ome',
            'method'       => $method,
            'date'         => date('Y-m-d H:i:s'),
            'format'       => 'json',
            'certi_id'     => $this->__channelObj->channel['certi_id'],
            'v'            => $this->__channelObj->channel['matrix_api_v'] ? $this->__channelObj->channel['matrix_api_v'] : '1',
            'from_node_id' => $this->__channelObj->channel['from_node_id'],
            'to_node_id'   => $this->__channelObj->channel['node_id'],
            'to_api_v'     => $this->__channelObj->channel['api_version'],
            'node_type'    => $this->__channelObj->channel['node_type'],
        );

        $app_xml = app::get('ome')->define();
        $query_params['from_api_v'] = $app_xml['api_ver'];

        return $query_params;
    }

    /**
     * 签名
     *
     * @param Array $params 参数
     * @return void
     * @author 
     **/
    public function gen_sign($params,$method=''){
        return strtoupper(md5(strtoupper(md5(self::assemble($params))).$this->__channelObj->channel['token']));
    }
}