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
 * 物流对帐任务处理类
 *
 * @author kamisama.xia@gmail.com 
 * @version 0.1
 */

class ome_autotask_timer_logistestimate
{
    public function process($params, &$error_msg=''){
        set_time_limit(0);
        ignore_user_abort(1);
        @ini_set('memory_limit','512M');
        
        //物流对帐任务开关(系统设置--》财务设置--》物流对帐设置)
        $logistestimateSet = app::get('ome')->getConf('ome.task.logistestimate');
        if($logistestimateSet == 'off'){
            //物流对帐任务已关闭
            //@todo：更新为当天执行日期，防止后面开启任务，执行时间范围过大，导致内存溢出；
            $now_time = mktime(0,0,0,date('m'),date('d'),date('Y'));
            app::get('logisticsaccounts')->setConf('logisticsaccounts.delivery.downtime', $now_time);
            
            return true;
        }
        
        kernel::single('logisticsaccounts_estimate')->crontab_delivery();

        return true;
    }
}