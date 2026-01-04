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

abstract class financebase_abstract_crontab{
	public $_interval_time = 1800; // 间隔时间
	public $_is_enable = true; // 是否启用
	abstract public function process();// 执行方式

    /**
     * __construct
     * @return mixed 返回值
     */
    public function __construct()
	{
		$this->oQueue = app::get('financebase')->model('queue');
		$this->financeObj = base_kvstore::instance('setting/financebase');
		$this->now_time = time();
		
	}

    /**
     * 获取Time
     * @return mixed 返回结果
     */
    public function getTime()
	{
		$this->financeObj->fetch($this->_time_key,$run_time);
		return $run_time?$run_time:0;
	}

    /**
     * 设置Time
     * @return mixed 返回操作结果
     */
    public function setTime()
	{
		$next_run_time = time() + $this->_interval_time;
		$this->financeObj->store($this->_time_key,$next_run_time);
		return true;
	}
}