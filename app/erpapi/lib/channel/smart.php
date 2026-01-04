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
 * Smart平台路由
 *
 * @author wangbiao@shopex.cn
 * @version 2024.04.23
 */
class erpapi_channel_smart extends erpapi_channel_abstract
{
    public $channel;
    public $wms;
    
    private static $wms_mapping = array(
        'jd_wms'       => '360buy',
        'sf_wms'       => 'sf',
    );
    
    /**
     * 初始化
     * @param mixed $node_id ID
     * @param mixed $channel_id ID
     * @return mixed 返回值
     */

    public function init($node_id, $channel_id)
    {
        $channelMdl = app::get('channel')->model('channel');
        $adapterModel = app::get('channel')->model('adapter');
        
        //channel
        $filter = $channel_id ? array('channel_id'=>$channel_id) : array('node_id'=>$node_id);
        $filter['channel_type'] = 'smart';
        $channelInfo = $channelMdl->dump($filter, '*');
        if (!$channelInfo) {
            return false;
        }
        
        $this->__adapter = 'matrix';
        
        //所属平台
        $this->__platform = '';
        if(!in_array($channelInfo['node_type'], array('publicwms', 'selfwms'))){
            $this->__platform = $channelInfo['node_type'];
        }
        
        //config
        $channelInfo['config'] = @unserialize($channelInfo['config']);
        
        //adapter
        $adapter = $adapterModel->dump(array('channel_id' => $channelInfo['channel_id']));
        $adapter['config'] = @unserialize($adapter['config']);
        
        $channelInfo['adapter'] = $adapter;
        
        $this->wms = $channelInfo;
        $this->channel = $channelInfo;
        
        return true;
    }
}