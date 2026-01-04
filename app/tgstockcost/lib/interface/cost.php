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


interface tgstockcost_interface_cost
{
	/**
	 * 获取仓库数据
	 * @params null
	 * @return bool
	 */
	//public function branch();

	/**
	 * 创建期初数据队列
	 * @params null
	 * @return bool
	 */
	public function create_queue();


	/**
	 * 执行期初数据队列
	 * @params null
	 * @return bool
	 */
	public function run_queue($params);


	/**
	 * 出入库操作计算成本方法
	 * @params $io出入库类型 $data出入库数据
	 * @return void
	 */
	function iostock_set($io,$data);
}