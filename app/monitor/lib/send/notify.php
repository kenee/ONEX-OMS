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

class monitor_send_notify
{
    
    function run(&$cursor_id, $params, &$errmsg)
    {
        define('FRST_OPER_NAME', 'system');
        define('FRST_TRIGGER_OBJECT_TYPE', '订单导入冻结库存');
        define('FRST_TRIGGER_ACTION_TYPE', 'monitor_send_notify：run');
        $data = explode('::',$params['method']);
        $class = $data[0];
        $method = $data[1];
        kernel::single($class)->$method($params['notify_id']);
        
        return false;
    }
}