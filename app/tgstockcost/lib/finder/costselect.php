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


 class tgstockcost_finder_costselect
 {
     var $column_control = '总仓单位平均成本';
     function column_control($row){
         list($prodcut_id,$branch_id) = explode('-',$row['id']);
         $entityCostList = kernel::single('ome_entity_branch_product')->getBranchCountCostPrice(intval($branch_id), intval($prodcut_id));
         $unitCost = $entityCostList[$branch_id][$prodcut_id]['unit_cost'];
         return $unitCost > 0 ? '￥'. $unitCost : '￥0.00';
     }
     
//	function detail_unit_cost($row)
//	{
//		$pbID = explode('-',$row);
//		$product_id = $pbID[0];
//		$branch_id = $pbID[1];
//		$setting_stockcost_cost = app::get("ome")->getConf("tgstockcost.cost");
//		if($setting_stockcost_cost == '4'){//先进先出
//			$fifo_mdl = app::get("tgstockcost")->model("fifo");
//			$fifo_data = $fifo_mdl->getList("*",array("branch_id"=>$branch_id,"product_id"=>$product_id),0,-1," id asc");
//		}
//		elseif($setting_stockcost_cost=='2' || $setting_stockcost_cost=='3'){//固定成本 或者平均
//			$dailystock = app::get("ome")->model("dailystock");
//			$daily_data = $dailystock->getList("stock_date,unit_cost",array('branch_id'=>$branch_id,'product_id'=>$product_id,'is_change'=>1),0,-1," id asc");
//			if(!$daily_data){
//				$branch_product = app::get("ome")->model("branch_product");
//				 $daily_data = $branch_product->getList('unit_cost',array('branch_id'=>$branch_id,'product_id'=>$product_id));
//				 $daily_data[0]['stock_date'] = date('Y--m-d',time());
//			}
//		}
//		else{
//			return "不计成本!,没有数据";
//		}
//		$render = app::get("tgstockcost")->render();
//		$render->pagedata['setting_stockcost_cost'] = $setting_stockcost_cost;
//		$render->pagedata['fifo_data'] = $fifo_data;
//		$render->pagedata['daily_data'] = $daily_data;
//		return  $render->fetch("admin/cost/detial.html");
//	}
 }