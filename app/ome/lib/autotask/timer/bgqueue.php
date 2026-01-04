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
 * 后台队列任务处理类
 *
 * @author kamisama.xia@gmail.com 
 * @version 0.1
 */

class ome_autotask_timer_bgqueue
{
    public function process($params, &$error_msg=''){
        set_time_limit(0);
        ignore_user_abort(1);
        $queueObj = app::get('base')->model('queue');
        $queues = $queueObj->getList('queue_id',array(),0,100);
        if($queues){
            foreach ($queues as $queue) {
                $queueObj->runtask($queue['queue_id']);
            }
        }

        return true;
    }
}