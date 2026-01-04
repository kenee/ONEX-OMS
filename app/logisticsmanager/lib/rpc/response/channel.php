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

class logisticsmanager_rpc_response_channel
{
    function callback($result){
        $channel_id = $result['channel_id'];
        $node_type  = $_POST['node_type'];
        $node_id    = $_POST['node_id'];
        $user_nick  = $_POST['user_nick'];
        $shop_title = $_POST['shop_title'];
        $vender_id  = $_POST['vender_id'];
        $unikey     = $_POST['unikey'];
        $status       = $_POST['status'];

        if (!$channel_id || !$node_id) die('0');

        $channelModel = app::get('logisticsmanager')->model('channel');

        $channel = $channelModel->dump($channel_id);

        if (!$channel) die('0');

        $addon = $channel['addon'] ? $channel['addon'] : array();
        if ($status == 'bind') {
            $addon['user_nick'] = $user_nick;

            $data = array(
                'node_id'     =>$node_id,
                'bind_status' =>'true',
                'addon'       => $addon
            );

            $channelModel->update($data,array('channel_id'=>$channel_id));
        } elseif ($status == 'unbind') {
            unset($addon['user_nick']);
            $channelModel->update(array('node_id'=>null,'bind_status'=>'false','addon'=>$addon),array('channel_id'=>$channel_id));
        }

        die('1');
    }
}