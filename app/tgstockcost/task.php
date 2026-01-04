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

class tgstockcost_task{

    function post_install(){
       // app::get("ome")->setConf("tgstockcost_install_time",time());//app安装时间放在OME APP里面 //todo 
       app::get("ome")->setConf("tgstockcost.installed",1);
    }
	function post_uninstall()
	{
		$iostock = app::get("ome")->model("iostock");
		$iostock->db->exec("update sdb_ome_iostock set unit_cost=0,inventory_cost=0,now_num=0,now_unit_cost=0,now_inventory_cost=0");
		$iostock->db->exec("update sdb_ome_branch_product set unit_cost=0,inventory_cost=0");
		$iostock->db->exec("delete from sdb_ome_dailystock");
		//$iostock->db->exec("delete from sdb_stockcost_fifo");
		app::get("ome")->setConf("tgstockcost.cost",'');
		app::get("ome")->setConf("tgstockcost.get_value_type",'');
		app::get("ome")->setConf("tgstockcost_install_time",'');
		app::get("ome")->setConf("tgstockcost.installed",0);
	}
}
