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


class eccommon_regions_select
{
	/**
	 * 通过p_region_id，区域层级来得到地区的信息
	 * @params object app object
	 * @params string p_region_id
	 * @params array 参数数组 - depth
	 * @params string 当前激活的regions id
	 */
	public function get_area_select($path, $params, $selected_id=null)
	{
		$params['depth'] = $params['depth']?$params['depth']:1;
        $html = '<select onchange="selectArea(this,this.value,'.($params['depth']+1).')">';
        if($params["effect"]){
            $html = '<select onchange="selectArea(this,this.value,'.($params['depth']+1).',\''.$params["effect"].'\')">';
        }
        $html.='<option value="_NULL_">请选择...</option>';

		$filter = ($path) ? array('region_grade' =>$params['depth'],'p_region_id'=>$path) : array('region_grade' =>$params['depth']);
		$obj_region = app::get('eccommon')->model('regions');
        if ($rows = $obj_region->getList('*', $filter, 0, -1, 'ordernum ASC'))
		{
            foreach ($rows as $item)
			{
                if ($item['region_grade']<=app::get('eccommon')->getConf('system.area_depth'))
				{
                    $selected = $selected_id == $item['region_id']?'selected="selected"':'';

					// 查找当前地区是否有子集
					//$filter = array('region_grade' =>$params['depth']+1,'p_region_id'=>$item['region_id']);  $c_rows = $obj_region->getList('*',$filter)
                    if ($item['haschild'] == 1)
					{
                        $html.= '<option has_c="true" value="'.$item['region_id'].'" '.$selected.'>'.$item['local_name'].'</option>';
                    }
					else
					{
                        $html.= '<option value="'.$item['region_id'].'" '.$selected.'>'.$item['local_name'].'</option>';
                    }
                }
				else
				{
                    $no = true;
                }
            }

            $html.='</select>';
            if($no) $html="";

            return $html;
        }
		else
		{
            return false;
        }
	}
}
