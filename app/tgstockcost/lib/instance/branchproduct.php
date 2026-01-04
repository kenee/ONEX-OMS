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


class tgstockcost_instance_branchproduct
{
	var $_instance=null;
	function __construct($app)
	{
		$config = base_setup_config::deploy_info();
		if($this->_instance) $this->_instance;
		else{
			//if($config['product_id'] == 'ECC-K')$this->_instance = kernel::single("stockcost_ocs_branchproduct");
			//else 
			$this->_instance = kernel::single("tgstockcost_taog_branchproduct");
		}
		$this->app = $app;
	}
	
	/*获取表名*/
	//public function table_name($real=false)
	//{
	//	return $this->_instance->table_name($real);
	//}
	/*
	*获取FINDER列表上仓库货品表数据
	*/
	function getList($cols='*', $filter=array(), $offset=0, $limit=-1, $orderType=null)
	{
		return $this->_instance->getList($cols, $filter, $offset, $limit, $orderType);
	}

	function branchproduct_count($filter = array()){
        return $this->_instance->branchproduct_count($filter);
	}
	
	function stock_count($filter = array()){
        return $this->_instance->stock_count($filter);
	}

    function header_getlist($cols = '*',$filter = array()){
    	return $this->_instance->header_getlist($cols,$filter);
    }

	/*收发汇总列表调用方法*/
	function stock_getList($cols='*', $filter=array(), $offset=0, $limit=-1, $orderType=null)
	{
		return $this->_instance->stock_getList($cols, $filter, $offset, $limit, $orderType);
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

    function exportName(&$data){
    	 $this->_instance->exportName($data);
    }

    function export_csv($data){
    	return $this->_instance->export_csv($data);
    }   
}