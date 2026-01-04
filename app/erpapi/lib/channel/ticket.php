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

class erpapi_channel_ticket extends erpapi_channel_abstract
{

    /**
     * 初始化
     * @param mixed $node_id ID
     * @param mixed $channel_id ID
     * @return mixed 返回值
     */
    public function init($node_id, $channel_id)
    {
        $channelMdl = app::get('channel')->model('channel');

        $filter                 = $channel_id ? array('channel_id' => $channel_id) : array('node_id' => $node_id);
        $filter['channel_type'] = 'ticket';
        $channel                    = $channelMdl->dump($filter);

        if (!$channel) {
            return false;
        }

        $channel['config'] = @unserialize($channel['config']);
        $this->__adapter = $channel['channel_adapter'];
        $this->__platform = $channel['node_type'];
        $this->channel = $channel;

        return true;
    }
}
