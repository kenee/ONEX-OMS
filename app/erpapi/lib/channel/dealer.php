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
 * 一件代发路由
 *
 * @author wangbiao@shopex.cn
 * @version 2024.04.11
 */
class erpapi_channel_dealer extends erpapi_channel_abstract
{
    public $channel;
    
    /**
     * 初始化
     * @param mixed $node_id ID
     * @param mixed $shop_id ID
     * @return mixed 返回值
     */

    public function init($node_id, $shop_id)
    {
        $filter = $shop_id ? array('shop_id'=>$shop_id) : array('node_id'=>$node_id);
        $shop = $this->get_shop($filter);
        
        if (!$shop || !$shop['node_id']){
            return false;
        }
        
        $this->channel = $shop;
        
        $this->__adapter = 'matrix';
        $this->__platform = $shop['node_type'];
        
        //tmall天猫
        if ($shop['node_type'] == 'taobao' && $shop['tbbusiness_type'] == 'B') {
            $this->__platform = 'tmall';
        }
        
        //订单类型
        $this->__platform_business = $shop['business_type'];
        
        return true;
    }
    
    private function get_shop($filter)
    {
        static $shops;

        $key = sprintf('%u',crc32(serialize($filter)));

        if ($shops[$key]) return $shops[$key];

        $shops_detail = app::get('ome')->model('shop')->dump($filter);
        if ($shops_detail['config']){
            $shops_detail['config'] = @unserialize($shops_detail['config']);
        }
        
        if (is_string($shops_detail['addon']) && $shops_detail['addon']){
            $shops_detail['addon'] = @unserialize($shops_detail['addon']);
        }
        
        $shops[$key] = $shops_detail;
        
        return $shops[$key];
    }
}