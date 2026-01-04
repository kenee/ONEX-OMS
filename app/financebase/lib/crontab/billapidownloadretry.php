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

class financebase_crontab_billapidownloadretry extends financebase_abstract_crontab
{

    /**
     * __construct
     * @return mixed 返回值
     */
    public function __construct()
    {
        $this->_time_key = sprintf("%s_time", __CLASS__);
        parent::__construct();
    }

    /**
     * 处理
     * @return mixed 返回值
     */
    public function process()
    {
        // 单线程执行
        base_kvstore::instance('financebase')->fetch(__CLASS__,$isRunning);
        if ($isRunning == 1) {
            return ;
        }

        base_kvstore::instance('financebase')->store(__CLASS__,1, 3600);

        $mdl = app::get('financebase')->model('queue');
        $queueList = $mdl->getList('queue_id', [
            'queue_mode'    => 'billApiDownload',
            'is_file_ready' => '0',
            'status'        => 'error',
        ]);

        foreach ($queueList as $queue) {
            $affect_rows = $mdl->update([
                'status' => 'ready',
            ],[
                'queue_id' => $queue['queue_id'],
                'status' => 'error',
                'is_file_ready' => '0',
            ]);

            if ($affect_rows === 1) {
                kernel::single('financebase_autotask_task_process')->process([
                    'queue_id' => $queue['queue_id'],
                ],$msg);
            }
        }

        base_kvstore::instance('financebase')->delete(__CLASS__);

        return ;
    }

    /**
     * 设置Time
     * @return mixed 返回操作结果
     */
    public function setTime()
    {
        // 加5分钟
        $next_run_time = strtotime('+5 minutes');

        $this->financeObj->store($this->_time_key, $next_run_time);

        return true;
    }
}