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

class o2o_event_trigger_logistics_data_electron_router {
    public $channel;

    /**
     * 设置Channel
     * @param mixed $channel channel
     * @return mixed 返回操作结果
     */
    public function setChannel($channel) {
        $this->channel = $channel;
        return $this;
    }

    /**
     * __call
     * @param mixed $method method
     * @param mixed $args args
     * @return mixed 返回值
     */
    public function __call($method,$args)
    {
        $platform = kernel::single('o2o_event_trigger_logistics_data_electron_common');
        if ($this->channel) {
            $channelType = $this->channel['channel_type'];
            try {
                if(class_exists('o2o_event_trigger_logistics_data_electron_'.$channelType)) {
                    $platform = kernel::single('o2o_event_trigger_logistics_data_electron_'.$channelType);
                }
            } catch (Exception $e) {}
        }
        $platform->setChannel($this->channel);
        return call_user_func_array(array($platform,$method), $args);
    }
}