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

/* 
 * 20160504
 * wangjianjun
 */
class omeauto_regions_li{

    /**
     * 获取_area_li
     * @param mixed $params 参数
     * @return mixed 返回结果
     */
    public function get_area_li($params){
	    $regionsObj = app::get('eccommon')->model('regions');
        
	    if($params["p_region_id"]){
	        $filter_arr = array("p_region_id"=>$params["p_region_id"]);
	    }else{
	        //新增或无p_region_id，则只需显示一级区域的checkbox列表即可
	        $filter_arr = array("region_grade"=>1);
	    }
	    
	    $html = '';
	    
	    $rows = $regionsObj->getList("*",$filter_arr);
	    if ($rows){
	        foreach ($rows as $item){
	            if ($item['region_grade'] <= app::get('eccommon')->getConf('system.area_depth')){
	                $html.= '<li style="cursor:pointer" value="'.$item['region_id'].'" onclick="doSelfRegion(this);">'.$item['local_name'].'</li>';
	            }else{
	                $no = true;
	            }
	        }
	    
	        if($no) $html="";
	    
	        return $html;
	    }else{
	        return "<li>无下级地区</li>";
	    }
	    
	}
}
