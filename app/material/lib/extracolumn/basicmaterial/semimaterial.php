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
 * 半成品明细信息
 * @author xiayuanjun@shopex.cn
 * @version 1.0
 */
class material_extracolumn_basicmaterial_semimaterial extends desktop_extracolumn_abstract implements desktop_extracolumn_interface{

    protected $__pkey = 'bm_id';

    protected $__extra_column = 'column_semi_material';

    /**
     *
     * 获取成品基础物料ID获取半成品物料信息
     * @param $ids
     * @return array $tmp_array关联数据数组
     */
    public function associatedData($ids){
        $basicMaterialCombinationItemsObj = app::get('material')->model('basic_material_combination_items');
        $seMiBasicMInfos = $basicMaterialCombinationItemsObj->getList('pbm_id,material_name,material_bn,material_num',array('pbm_id'=>$ids), 0, -1);

        $tmp_array= array();
        foreach($seMiBasicMInfos as $k=>$basicMaterial){
            if(isset($tmp_array[$basicMaterial['pbm_id']])){
                $tmp_array[$basicMaterial['pbm_id']] .= "  |  ".$basicMaterial['material_name']."(".$basicMaterial['material_bn'].") x ".$basicMaterial['material_num'];
            }else{
                $tmp_array[$basicMaterial['pbm_id']] = $basicMaterial['material_name']."(".$basicMaterial['material_bn'].") x ".$basicMaterial['material_num'];
            }
        }
        return $tmp_array;
    }

}