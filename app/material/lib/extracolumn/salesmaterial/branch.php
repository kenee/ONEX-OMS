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
 * 销售物料字段包装单位
 * @author xiayuanjun@shopex.cn
 * @version 1.0
 */
class material_extracolumn_salesmaterial_branch extends desktop_extracolumn_abstract implements desktop_extracolumn_interface{

    protected $__pkey = 'sm_id';

    protected $__extra_column = 'column_branch';

    /**
     *
     * 获取基础物料字段售价
     * @param $ids //sm_ids
     * @return array $tmp_array关联数据数组
     */
    public function associatedData($ids){
        $_salesBasicMaterialObj = app::get('material')->model('sales_basic_material');
        $salesBasicMInfos = $_salesBasicMaterialObj->getList('bm_id,sm_id,number,rate',array('sm_id'=>$ids), 0, -1);
        if ($salesBasicMInfos) {
            foreach($salesBasicMInfos as $k => $salesBasicMInfo)
            {
                $bmIds[] = $salesBasicMInfo['bm_id'];
                $bmAndSmRates[$salesBasicMInfo['sm_id']][$salesBasicMInfo['bm_id']] = $salesBasicMInfo;
            }
            //获取库存
            $_basicMaterialStoreModel  = app::get('ome')->model('branch_product');

            $basic_material_branch= array();
            $basicMaterialBranches = $_basicMaterialStoreModel->getBranchByBasic('b.branch_id,b.name,bp.product_id', array('bm_id'=>$bmIds), 0, -1);
            if ($basicMaterialBranches)
            {
                foreach ($basicMaterialBranches as $key => $row) {
                    $basic_material_branch[$row['product_id']] = $row;
                }
            }

            $bmList    = array();
            foreach ($bmAndSmRates as $sm_key => $sales_basic_material_list)
            {
                foreach ($sales_basic_material_list as $bm_key => $bm_item)
                {
                    $bmList[$sm_key][]    = $basic_material_branch[$bm_key];
                }
            }
            $tmp_array = array();
            foreach($bmList as $sm_id=>$basicMaterials){
                foreach($basicMaterials as $k =>$basicMaterial){
                    if(isset($tmp_array[$sm_id])){
                        $tmp_array[$sm_id] .= "  |  ".$basicMaterial['name'];
                    }else{
                        $tmp_array[$sm_id] = $basicMaterial['name'];
                    }
                }
            }
            return $tmp_array;
        }
        return false;
    }

}