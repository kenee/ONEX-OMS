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

/**
 * @Author: xueding@shopex.cn
 * @Date: 2023/2/16
 * @Describe: 预警消息finder类
 */
class monitor_finder_event_notify
{

    var $detail_basic = '详情';
    function detail_basic($notify_id)
    {
        $render = app::get('ome')->render();
        $eventNotifyMdl = app::get('monitor')->model('event_notify');
        $notifyInfo = $eventNotifyMdl->db_dump($notify_id);
        $render->pagedata['detail'] = $notifyInfo;
    
        return $render->fetch('admin/alarm/event/detail_basic.html','monitor');
    }
}