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


class tgstockcost_instance_iostockrecord
{
	var $_instance=null;
	function __construct($app)
	{
		$config = base_setup_config::deploy_info();
		if($this->_instance) $this->_instance;
		else{
			//if($config['product_id'] == 'ECC-K')$this->_instance = kernel::single("stockcost_ocs_iostockrecord");
			//else 
			$this->_instance = kernel::single("tgstockcost_taog_iostockrecord");
		}
		$this->app = $app;
	}
	
	/*获取仓库对应的货品出入库流水记录
	*/
	function get_iostock($branch_id=null,$start_time=null,$end_time=null,$bn=null,$offset=0,$limit=-1)
	{
		return $this->_instance->get_iostock($branch_id,$start_time,$end_time,$bn,$offset,$limit);
	}
	/*获取导出链接URL*/
	function get_export_href($params)
	{
		return $this->_instance->get_export_href($params);
	}

	/*组织导出数据 OCS 走默认的*/
	function fgetlist_csv(&$data,$filter,$offset,$exportType =1,$pass_data=false){
		return $this->_instance->fgetlist_csv($data,$filter,$offset,$exportType,$pass_data);
	}
}