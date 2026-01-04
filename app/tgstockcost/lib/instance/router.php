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


class tgstockcost_instance_router
{
	var $_instance = null;
	function __construct($app)
	{
		$config = base_setup_config::deploy_info();
		if($this->_instance) $this->_instance;
		else{
			//if($config['product_id'] == 'ECC-K')$this->_instance = kernel::single("stockcost_ocs_instance");
			//else 
			$this->_instance = kernel::single("tgstockcost_taog_instance");
		}
		$this->app = $app;
	}
	/*
	*创建期初数据队列
	*/
	function create_queue()
	{
		$this->_instance->create_queue();
	}
	/*出入库调用方法  各自实现*/
	function iostock_set($io,$data)
	{
		$this->_instance->iostock_set($io,$data);
	}
	/*销售出库时记录销售单毛利率等字段方法*/
	function set_sales_iostock_cost($io,$data)
	{
		$this->_instance->set_sales_iostock_cost($io,$data);
	}
	
}