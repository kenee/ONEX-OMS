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

class ome_event_trigger_exrecommend_data_recommend_router
{
    private $channel_type;
    
    public function setChannel($channel_type) {
        $this->channel_type = $channel_type;
        return $this;
    }
    
    public function __call($method,$args)
    {
       $platform = kernel::single('ome_event_trigger_exrecommend_data_recommend_common');
        if ($this->channel_type) {
            $channelType = $this->channel_type;
            try {
                $platform = kernel::single('ome_event_trigger_exrecommend_data_recommend_'.$channelType);
            } catch (Exception $e) {}
        }
        return call_user_func_array(array($platform,$method), $args);
    }  
}