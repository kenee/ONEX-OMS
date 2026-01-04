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
 * @author chenping@shopex.cn 2017/5/24
 * @describe 无需授权接口
 */
class erpapi_channel_noauth extends erpapi_channel_abstract {
    public $channel;

    /**
     * 初始化
     * @param mixed $node_id ID
     * @param mixed $node_type node_type
     * @return mixed 返回值
     */

    public function init($node_id, $node_type) {
        // 利用CC上的绑定店铺
        $this->channel = array(
            'node_type'    => 'taobao',
            'node_id'      => '1065393031',
            'shop_type'    => 'taobao',
            'certi_id'     => '1167790537',
            'from_node_id' => '1182778034',
            'token'        => '1082f8c19a445aea6f41c8badf71b33ca6cd2e139b99bc41295c6440f2511276',
        );

        // 判读是否有淘宝点
        $taobaoShop = app::get('ome')->model('shop')->getList('node_type,node_id',array('node_type'=>'taobao','filter_sql'=>"node_id!='' AND node_id is not null"));
        if ($taobaoShop) {
            $this->channel['node_id']      = $taobaoShop[0]['node_id'];
            $this->channel['certi_id']     = base_certificate::certi_id();
            $this->channel['from_node_id'] = base_shopnode::node_id('ome');
            $this->channel['token']        = base_certificate::token();
        }

        $this->__adapter  = 'matrix';
        $this->__platform = 'taobao';

        return true;
    }
}