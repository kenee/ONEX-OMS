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
 * 自动对账处理类
 *
 * @author kamisama.xia@gmail.com 
 * @version 0.1
 */

class ome_autotask_timer_financecronjob
{
    public function process($params, &$error_msg=''){
        set_time_limit(0);
        ignore_user_abort(1);

        //判断是否安装不安装直接返回成功
        if(!app::get('finance')->is_installed()){
            return true;
        }
        
        //一小时跑一次
        kernel::single('finance_cronjob_tradeScript')->trade_search_queue();
        kernel::single('finance_cronjob_tradeScript')->get_taskid_result();
        kernel::single('finance_cronjob_tradeScript')->taskid_queue();
        //kernel::single('finance_cronjob_tradeScript')->autoretry();
        kernel::single('finance_cronjob_tradeScript')->get_sales();
        //kernel::single('finance_cronjob_autoflagScript')->autoflag_queue();

        return true;
    }
}