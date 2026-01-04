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
/**
 * o2o 二期
 * 20160810
 * @author wangjianjun@shopex.cn
 * @version 1.0
 */
class o2o_extracolumn_branchproduct_brandname extends o2o_extracolumn_abstract implements o2o_extracolumn_interface{

    protected $__pkey = 'id';

    protected $__extra_column = 'column_brand_name';

    /**
     * 统一获取主键和brand_name品牌之间的关系
     * @param $ids
     */

    public function associatedData($ids){
        //根据主键获取bm_ids
        $mdlO2oBranchProduct = app::get('o2o')->model('branch_product');
        $mdlMaterialBasicExt = app::get('material')->model('basic_material_ext');
        $mdlOmeBrand = app::get('ome')->model('brand');
        $rs_info = $mdlO2oBranchProduct->getList("*",array("id|in"=>$ids));
        $bm_ids = array();
        foreach ($rs_info as $var_info){
            if($var_info["bm_id"] && !in_array($var_info["bm_id"],$bm_ids)){
                $bm_ids[] = $var_info["bm_id"];
            }
        }
        
        //获取bm_id和brand_id之间的关系
        $rs_material = $mdlMaterialBasicExt->getList("bm_id,brand_id",array("bm_id|in"=>$bm_ids));
        $brand_ids = array();
        foreach ($rs_material as $var_material){
            if($var_material["brand_id"] && !in_array($var_material["brand_id"],$brand_ids)){
                $brand_ids[] = $var_material["brand_id"];
            }
        }
        
        //获取brand_id和brand_name品牌之间的关系
        $rs_brand = $mdlOmeBrand->getList("brand_id,brand_name",array("brand_id|in"=>$brand_ids));
        $rl_brand_id_brand_name = array();
        foreach ($rs_brand as $var_brand){
            $rl_brand_id_brand_name[$var_brand["brand_id"]] = $var_brand["brand_name"];
        }
        
        //获取bm_id和brand_name品牌之间的关系
        $rl_bm_id_brand_name = array();
        foreach ($rs_material as $var_material){
            $rl_bm_id_brand_name[$var_material["bm_id"]] = $rl_brand_id_brand_name[$var_material["brand_id"]];
        }
        
        //最终获取主键和brand_name品牌之间的关系
        $return_arr = array();
        foreach ($rs_info as $item_info){
            $return_arr[$item_info["id"]] = "-";
            if($rl_bm_id_brand_name[$item_info["bm_id"]]){
                $return_arr[$item_info["id"]] = $rl_bm_id_brand_name[$item_info["bm_id"]];
            }
        }
        
        return $return_arr;
    }

}