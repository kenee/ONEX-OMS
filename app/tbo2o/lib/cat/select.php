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
 * 阿里全渠道类目select选择项
 */
class tbo2o_cat_select{

    //获取类目层级select/options
    /**
     * 获取_cat_select
     * @param mixed $path path
     * @param mixed $params 参数
     * @param mixed $selected_id ID
     * @return mixed 返回结果
     */
    public function get_cat_select($path, $params, $selected_id=null){
        $params['depth'] = $params['depth']?intval($params['depth']):1;
        $html = '<select onchange="selectTbo2oStoreCat(this,this.value,'.($params['depth']+1).',0)">';
        $html.='<option value="_NULL_">请选择...</option>';
		$filter = ($path) ? array('cat_grade' =>$params['depth'],'p_stc_id'=>$path) : array('cat_grade' =>$params['depth']);
		$mdlTbo2oStoreCat = app::get('tbo2o')->model('store_cat');
		$rows = $mdlTbo2oStoreCat->getList('*', $filter, 0, -1, 'stc_id ASC');
        if (!empty($rows)){
            foreach ($rows as $item){
                //目前组织结构最大五层层级
                if ($item['cat_grade']<=4){
                    $selected = $selected_id == $item['cat_id']?'selected="selected"':'';
                    if (intval($item['haschild']) > 0){
                        $html.= '<option has_c="true" value="'.$item['cat_id'].'" '.$selected.'>'.$item['cat_name'].'</option>';
                    }else{
                        $html.= '<option value="'.$item['cat_id'].'" '.$selected.'>'.$item['cat_name'].'</option>';
                    }
                }else{
                    $no = true;
                }
            }
        }
        $html.='</select>';
        if($no){
            $html = "";
        }
        return $html;
	}
	
}
