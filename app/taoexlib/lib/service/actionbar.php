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

class taoexlib_service_actionbar {
	
	function getOmeanalystsDelivery(){
		// 新增app：接管csv导出任务
		return array(
					array(
					'label'=>'导出任务',
					'id'=>'export_task',
					'href'=>'index.php?app=taoexlib&ctl=ietask&act=export_task&e_app=omeanalysts&e_model=ome_delivery&task_name=快递费结算表',
					//index.php?app=ome&ctl=admin_order&act=index&_finder%5Bfinder_id%5D=d58620&action=export&finder_id=d58620
					'target'=>"dialog::{width:400,height:170,title:'导出'}"),
				);
	}
	
	function getActionBar(){
		// 新增app：接管csv导出任务
		return array(
					array(
					'label'=>'导出任务',
					'id'=>'export_task',
					'submit'=>'index.php?app=taoexlib&ctl=ietask&act=export_task&e_app=ome&e_model=orders&task_name='.base64_encode('订单'),
					//index.php?app=ome&ctl=admin_order&act=index&_finder%5Bfinder_id%5D=d58620&action=export&finder_id=d58620
					'target'=>"dialog::{width:400,height:170,title:'导出任务'}"),
				);
	}                    
}