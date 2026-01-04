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
 +----------------------------------------------------------
 * 门店库存
 +----------------------------------------------------------
 * 20160815 wangjianjun
 +----------------------------------------------------------
 */
class o2o_ctl_admin_product_store extends desktop_controller{
    
    function index(){
        
        $base_filter = array();
        
        //过滤物料编码 类别头部筛选
        $post_material_bn = trim($_POST['material_bn']);
        if($post_material_bn){
            //获取bm_id
            $mdlMaterialBasicMaterial = app::get('material')->model('basic_material');
            $rs_bm_id = $mdlMaterialBasicMaterial->dump(array("material_bn"=>$post_material_bn),"bm_id");
            $base_filter['bm_id'] = $rs_bm_id['bm_id'];
        }
        
        //过滤选择门店的下拉框 类别头部筛选
        $post_selected_store_bn = trim($_POST['selected_store_bn']);
        if($post_selected_store_bn && $post_selected_store_bn!="_NULL_"){
            //获取branch_id
            $mdlOmeBranch = app::get('ome')->model('branch');
            $rs_branch_id = $mdlOmeBranch->dump(array("branch_bn"=>$post_selected_store_bn),"branch_id");
            $base_filter['branch_id'] = $rs_branch_id['branch_id'];
        }
        
        $params = array(
            'title'=>'门店库存',
            'use_buildin_recycle'=>false,
            'use_buildin_export'=>true,
            'base_filter'=>$base_filter,
            'orderBy'=>'branch_id asc',
        );
        
        //top filter
        if(!isset($_GET['action'])) {
            $panel = new desktop_panel($this);
            $panel->setId('product_store_finder_top');
            $panel->setTmpl('admin/finder/branch_product_finder_panel_filter.html');
            $panel->show('o2o_mdl_product_store', $params);
        }
        
        $this->finder('o2o_mdl_product_store', $params);
    }
    
}
