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

class omeanalysts_ctl_ome_goodsrank extends desktop_controller{
	
    /**
     * chart_view
     * @param mixed $filter filter
     * @return mixed 返回值
     */
    public function chart_view($filter=null) {
		$type=$_GET['type'];
        $filter = array(
            'time_from' => $_GET['time_from'],
            'time_to' => $_GET['time_to'],
        	'type_id' => $_GET['type_id'],
        	'order_status' => $_GET['order_status'],
        );
        $goodsObj = $this->app->model('ome_goodsrank');
         $goods_name = array();
         $sale_num = array();
         
         if ($type=='hotGoods'){
         	$data = $goodsObj->getlist('*',$filter,0,20,'sale_num desc');
         	foreach ($data as $val){
         		$goods_name[] = '\''.$val['name'].'\'';
         		$sale_num[] = $val['sale_num'];
         	}
         	$categories = implode(',',$goods_name);
         	$volume = implode(',',$sale_num);       	         	
		        	
         	$this->pagedata['categories'] = '['.$categories.']';
         	$this->pagedata['data']='{
         		name: \'热销排行\',
         		data: ['.$volume.']
         	}';
         }else if ($type=='dullGoods'){
         	$data = $goodsObj->getlist('*',$filter,0,20,'sale_num');
         	foreach ($data as $val){
         		$goods_name[] = '\''.$val['name'].'\'';
         		$sale_num[] = $val['sale_num'];
         	}
         	$categories = implode(',',$goods_name);
         	$volume = implode(',',$sale_num);
         	       	
         	$this->pagedata['categories'] = '['.$categories.']';
         	$this->pagedata['data']='{
         		name: \'滞销排行\',
         		data: ['.$volume.']
         	}';
         }
         $this->display("ome/chart_type_column.html");
	}
	
}
?>