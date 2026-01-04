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
/**
 * CONFIG
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_shop_config extends erpapi_config
{
    /**
     * 初始化
     * @param erpapi_channel_abstract $channel channel
     * @return mixed 返回值
     */

    public function init(erpapi_channel_abstract $channel){

        if($channel->channel['delivery_mode'] == 'jingxiao') {
            $this->__whitelist = [SHOP_TRADE_FULLINFO_RPC];
        } else {
            $this->__whitelist = kernel::single('erpapi_shop_whitelist')->getWhiteList($channel->channel['node_type']);
        }

      
        return parent::init($channel);
    }
    /**
     * 应用级参数
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
            'certi_id'     => base_certificate::certi_id(),
            'v'            => $this->__channelObj->channel['matrix_api_v'] ? $this->__channelObj->channel['matrix_api_v'] : '1',
            'from_node_id' => base_shopnode::node_id('ome'),
            'to_node_id'   => $this->__channelObj->channel['node_id'],
            // 'to_api_v'     => $this->__channelObj->channel['api_version'],
            'node_type'    => $this->__channelObj->channel['node_type'],
        );

        if ($this->__channelObj->channel['api_version']) {
            $query_params['to_api_v'] = $this->__channelObj->channel['api_version'];
        }

        //拼多多设备指纹携带请求头
        if ($this->__channelObj->channel['node_type'] == 'pinduoduo') {
            $pageCode = $_COOKIE['pdd_page_code'];
            if ($pageCode) {
                $query_params['headers']['X-PDD-PageCode'] = $pageCode;
            }
            if ($_COOKIE[$pageCode]) {
                $query_params['headers']['X-PDD-Pati'] = $_COOKIE[$pageCode];
            }
        }

        $app_xml = app::get('ome')->define();
        $query_params['from_api_v'] = $app_xml['api_ver'];

        return $query_params;
    }
}