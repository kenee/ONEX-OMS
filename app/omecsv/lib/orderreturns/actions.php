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

class omecsv_orderreturns_actions{


    function action_modify(&$actions){
		kernel::log("action_modify = ".$actions);
		foreach($actions as $key=>$action){
			if($action['label']=="导入"){
				 $actions[$key] = array('label'=>app::get('desktop')->_('导入'),'icon'=>'upload.gif','href'=>'index.php?app=omecsv&ctl=admin_import&act=main&ctler=iostock_mdl_orderreturns&add=iostock','target'=>'dialog::{width:400,height:150,title:\''.app::get('desktop')->_('导入').'\'}');
			}
		}

    }



}
?>
