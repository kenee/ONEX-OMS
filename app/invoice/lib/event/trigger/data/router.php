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
 * 路由
 */
class invoice_event_trigger_data_router
{
    private $__shop_id;
    
    public function set_shop_id($shop_id)
    {
        $this->__shop_id = $shop_id;
    
        return $this;
    }
    
    public function __call($method,$args)
    {
       $platform = kernel::single('invoice_event_trigger_data_common');
       
        if ($this->__shop_id) {
            $obj_channel = app::get('invoice')->model('channel');
            
            //获取店铺所属的电子发票渠道
            $rs = $obj_channel->get_channel_info($this->__shop_id);
            if($rs['channel_type']){
                $channelType = $rs['channel_type'];
                
                try {
                    $platform = kernel::single('invoice_event_trigger_data_'.$channelType);
                } catch (Exception $e) {}
            }
        }
        
        return call_user_func_array(array($platform, $method), $args);
    }  
}