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
 * ShopEX License
 *
 * @author dqiujing@gmail.com
 * @version ocs
 */

return array(
    'loop' => array(
        'minite' => array(
            array(
                'title' => '按店铺生成实时请求交易记录队列',
                'queue' => 'slow',
                'worker' => 'trade_search_queue@finance_cronjob_tradeScript'
            ),
            array(
                'title' => '获取交易任务号结果',
                'queue' => 'slow',
                'worker' => 'get_taskid_result@finance_cronjob_tradeScript'
            ),
            array(
                'title' => '按任务日志表生成自动重试请求队列',
                'queue' => 'slow',
                'worker' => 'autoretry@finance_cronjob_tradeScript'
            ),
            array(
                'title' => '按店铺生成获取交易任务号队列',
                'queue' => 'slow',
                'worker' => 'taskid_queue@finance_cronjob_tradeScript'
            ),
            array(
                'title' => '定时拉销售数据',
                'queue' => 'slow',
                'worker' => 'get_sales@finance_cronjob_tradeScript',
            ),
        ),
        'hour' => array(
            array(
                'title' => '账单自动核销队列',
                'queue' => 'slow',
                'worker' => 'autoflag_queue@finance_cronjob_autoflagScript'
            )
        )
    )
);
