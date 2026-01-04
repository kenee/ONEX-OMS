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


class tgstockcost_ctl_costdetail extends desktop_controller
{
	function __consruct($app)
	{
		$this->app = $app;
		parent::__construct($app);
	}
	function index()
	{
		$branch_mdl = app::get("ome")->model("branch");
		$branch_data = $branch_mdl->getList("branch_id,name");
		$data['start_time'] = app::get("ome")->getConf("tgstockcost_install_time");
		$data['end_time'] = time();
		$this->pagedata['data'] = $data; 
		$this->pagedata['branch_data'] = $branch_data; 
		$iostock = kernel::single("tgstockcost_instance_iostockrecord");
		$href_export = $iostock->get_export_href(array());
		$this->pagedata['href_export'] = $href_export;
        $this->page("admin/costview.html");
	}
	
	function view_detail()
	{
		$branch_id=$_GET['branch_id'];
		$start_time = $_GET['start_time'];
		$end_time = $_GET['end_time'];
		$bn_arr = $_GET['bn'];
		if(empty($branch_id)){
			header('Content-Type:text/html; charset=utf-8');
			echo "仓库不能为空！";exit;
		}
		if(empty($start_time)){
			header('Content-Type:text/html; charset=utf-8');
			echo "开始时间不能为空！";exit;
		}
		if(empty($end_time)){
			header('Content-Type:text/html; charset=utf-8');
			echo "结束不能为空！";exit;
		}
		$stockcost_install_time = app::get("ome")->getConf("tgstockcost_install_time");
		if((strtotime($start_time)+24*3600)<$stockcost_install_time){
			header('Content-Type:text/html; charset=utf-8');
			echo "起始时间不能早于成本开始计算时间  成本开始计算时间为:".date('Y-m-d ',$stockcost_install_time);exit;
		}
		$_GET['page'] = 1;
		$this->pagedata['get_params'] = $_GET;
		$this->singlepage("admin/costdetail.html");
	}
	
	function view_detail_ajax()
	{
		$branch_id= $_POST['branch_id'];
		$start_time= $_POST['start_time'];
		$end_time= $_POST['end_time'];
		$bn_arr= $_POST['bn'];
		$limit = 100;
		$page = $_POST['page'];
		$start = ($page-1)*$limit;
		//$start_time = strtotime($start_time);
		//$end_time = strtotime($end_time);
		$iostock = kernel::single("tgstockcost_instance_iostockrecord");
		$iostock_data = $iostock->get_iostock($branch_id,$start_time,$end_time,$bn_arr,$start,$limit);
		if($iostock_data){
			$this->pagedata['iostock_data'] = $iostock_data;
			$json_data['costdetail_data'] = $this->fetch("admin/costdetail_more.html");
	    }
		else
		{
			$json_data['end'] = 'true'; 
		}
		echo json_encode($json_data);
		exit;
	}
	function download()
	{

	}
}