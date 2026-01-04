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

class monitor_event_trigger_notify_router
{
    private $__send_type;
    
    public function set_send_type($send_type)
    {
        $this->__send_type = $send_type;
        
        return $this;
    }
    
    public function __call($method, $args)
    {
        $platform = kernel::single('monitor_event_trigger_notify_common');

        try {
            $className = sprintf('monitor_event_trigger_notify_%s',$this->__send_type);
    
            if (class_exists($className)) {
                $platform = kernel::single($className);
            }
            
        } catch (Exception $e) {
        
        }
        
        return call_user_func_array(array($platform, $method), $args);
    }
}
