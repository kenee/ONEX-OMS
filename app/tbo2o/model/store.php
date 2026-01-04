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

class tbo2o_mdl_store extends dbeav_model{

    //同步状态
    function modifier_sync($row){
        switch ($row){
            case "1":
                $sync_text = "未同步";
                break;
            case "2":
                $sync_text = "同步失败";
                break;
            case "3":
                $sync_text = "同步成功";
                break;
        }
        return $sync_text;
    }
    
    //门店类目
    function modifier_cat_id($row){
        $str_cat_name = "";
        $mdltbo2oStoreCat = app::get('tbo2o')->model('store_cat');
        $rs_cat = $mdltbo2oStoreCat->dump(array("cat_id"=>$row),"cat_path");
        if($rs_cat["cat_path"]){
            $arr_cat = explode(",",$rs_cat["cat_path"]);
            $rs_cats = $mdltbo2oStoreCat->getList("cat_id,cat_name",array("cat_id|in"=>$arr_cat));
            $rl_c_id_c_name = array();
            foreach ($rs_cats as $v_c){
                $rl_c_id_c_name[$v_c["cat_id"]] = $v_c["cat_name"];
            }
            foreach ($arr_cat as $a_k => $a_c){
                $t_c_name = $rl_c_id_c_name[$a_c];
                if($a_k > 0){
                    $t_c_name = "/".$t_c_name;
                }
                $str_cat_name .= $t_c_name;
            }
        }
        return $str_cat_name;
    }
    
}