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

class financebase_crontab_syncaftersales extends financebase_abstract_crontab
{
    /**
     * __construct
     * @return mixed 返回值
     */
    public function __construct()
        {        
                $this->_time_key = sprintf("%s_time",__CLASS__);
                parent::__construct();
        }
        
    /**
     * 处理
     * @return mixed 返回值
     */
    public function process()
	{
		$queueData = array();
                $queueData['queue_mode'] = 'syncAftersales';
                $queueData['create_time'] = $this->now_time;
                $queueData['queue_name'] = "同步应退单";
                $queueData['queue_data'] = array();
                $queue_id = $this->oQueue->insert($queueData);
                $queue_id and financebase_func::addTaskQueue(array('queue_id'=>$queue_id),'syncaftersales');
                return true;
	}
}