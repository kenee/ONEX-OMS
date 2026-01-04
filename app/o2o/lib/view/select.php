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


class o2o_view_select{
    
    function list_store($params){
        
        $set_select_name    = ($params['set_select_name'] ? $params['set_select_name'] : 'selected_store_bn');//选择表单名称
        
        $html = '<select onchange="type_radio(this);" name="'. $set_select_name .'">';
        $html.='<option value="_NULL_">请选择...</option>';

        if (!$params["p_org_id"]){
            //首次加载 获取全部门店
            $mdlOrganization = app::get('organization')->model('organization');
            $rs_orgs = $mdlOrganization->getList("*",array("org_type"=>2,"del_mark"=>0));
            if(!empty($rs_orgs)){
                foreach ($rs_orgs as $var_org){

                    if ($var_org["org_no"] == $params['store_bn'])
                        $html.='<option value="'.$var_org["org_no"].'" selected>'.$var_org["org_name"].'</option>';
                    else
                        $html.='<option value="'.$var_org["org_no"].'">'.$var_org["org_name"].'</option>';
                }
            }
            $html.='</select>';
            return $html;
        }
        
        $show_list = array();
        $rs_temp = $this->get_child_items(array($params["p_org_id"]));
        do{
            if(empty($rs_temp)){
                break;
            }
            $target_p_org_ids = array();
            foreach ($rs_temp as $var_temp){
                $org_type = intval($var_temp["org_type"]);
                if($org_type == 2){
                    //是有效门店的
                    $temp_show_arr = array(
                        "org_no" => $var_temp["org_no"],
                        "org_name" => $var_temp["org_name"],
                    );
                    $show_list[] = $temp_show_arr;
                }
                if($org_type == 1){
                    //是有效组织层级的
                    $target_p_org_ids[] = $var_temp["org_id"];
                }
            }
            $rs_temp = $this->get_child_items($target_p_org_ids);
        }while (!empty($target_p_org_ids));
        
        if(!empty($show_list)){
            foreach ($show_list as $var_show_arr){
                $html.='<option value="'.$var_show_arr["org_no"].'">'.$var_show_arr["org_name"].'</option>';
            }
        }
        
        $html.='</select>';
        return $html;
    
    }
    
    private function get_child_items($target_p_org_ids){
        if(empty($target_p_org_ids)){
            return array();
        }
        $mdlOrganization = app::get('organization')->model('organization');
        $return_orgs = $mdlOrganization->getList("*",array("parent_id|in"=>$target_p_org_ids,"del_mark"=>0));
        return $return_orgs;
    }
    
}
