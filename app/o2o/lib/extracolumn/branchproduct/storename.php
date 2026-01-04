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

/**
 * o2o 二期
 * 20160810
 * @author wangjianjun@shopex.cn
 * @version 1.0
 */
class o2o_extracolumn_branchproduct_storename extends o2o_extracolumn_abstract implements o2o_extracolumn_interface{

    protected $__pkey = 'id';

    protected $__extra_column = 'column_store_name';

    /**
     * 统一获取主键和授权门店之间的关系
     * @param $ids
     */
    public function associatedData($ids){
        //根据主键获取branch_ids
        $mdlO2oBranchProduct = app::get('o2o')->model('branch_product');
        $mdlOmeBranch = app::get('ome')->model('branch');
        $rs_info = $mdlO2oBranchProduct->getList("*",array("id|in"=>$ids));
        $branch_ids = array();
        foreach ($rs_info as $var_info){
            if($var_info["branch_id"] && !in_array($var_info["branch_id"],$branch_ids)){
                $branch_ids[] = $var_info["branch_id"];
            }
        }
        
        //获取branch_id和branch_name之间的关系
        $rs_branch = $mdlOmeBranch->getList("branch_id,name",array("branch_id|in"=>$branch_ids));
        $rl_branch_id_name = array();
        foreach ($rs_branch as $var_branch){
            $rl_branch_id_name[$var_branch["branch_id"]] = $var_branch["name"];
        }
        
        //最终获取主键和branch_name之间的关系
        $return_arr = array();
        foreach ($rs_info as $item_info){
            $return_arr[$item_info["id"]] = $rl_branch_id_name[$item_info["branch_id"]];
        }
        
        return $return_arr;
    }

}