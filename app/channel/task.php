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

class channel_task{

    function post_install($options){
        // 插入默认奇门渠道
        $this->_insert_qimen_channel();
    }

    /**
     * 插入默认奇门渠道
     */
    private function _insert_qimen_channel(){
        $channelMdl = app::get('channel')->model('channel');
        // 检查是否已存在
        $exists = $channelMdl->getList('channel_id', array('channel_type' => 'qimen'), 0, 1);
        if (empty($exists)) {
            $data = array(
                'channel_bn' => 'qimen-jst-erp',
                'channel_name' => '奇门聚石塔内外互通',
                'channel_type' => 'qimen',
                'active' => 'true',
                'disabled' => 'false',
                'node_type' => 'qimen-jst-erp',
            );
            $channelMdl->insert($data);
        }
    }
}
