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
 * 华强宝
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_channel_hqepay extends erpapi_channel_abstract
{
    public $channel;

    /**
     * 初始化
     * @param mixed $node_id ID
     * @param mixed $hqepay_id ID
     * @return mixed 返回值
     */

    public function init($node_id, $hqepay_id)
    {
        $this->__adapter  = '';
        $this->__platform = '';

        $this->channel['hqepay_id'] = $hqepay_id;

        // 查询绑定的快递鸟
        $channel = app::get('channel')->model('channel')->dump([
            'channel_type' => 'kuaidi',
            'node_type'    => 'kdn',
            'filter_sql'   => 'node_id IS NOT NULL AND node_id!=""',
        ]);

        if (!$channel) {
        	return false;
        }

        $this->channel = $channel;

        return true;
    }
}
