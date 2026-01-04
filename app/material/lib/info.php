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

class material_info{

    /**
     * 物料相关信息
     */
    public function get_material_info($keyword)
    {
        $material_basic = app::get('material')->model('basic_material');
        $material_ext_obj = app::get('material')->model('basic_material_ext');
        $ome_brand_obj = app::get('ome')->model('brand');
        $basicMaterialBarcode = kernel::single('material_basic_material_barcode');


        $bm_id = $material_basic->getList('bm_id',array('material_bn' => $keyword), 0, 1);
        if(empty($bm_id)){
            $bm_id = $material_basic->getList('bm_id',array('material_name' => $keyword), 0, 1);
            if(empty($bm_id)){
                $bm_id = $basicMaterialBarcode->getIdByBarcode($keyword);
            }
        }
        if(empty($bm_id)){
            return false;
        }
        $material_ext = $material_ext_obj->getList('*', array('bm_id' => $bm_id[0]['bm_id']), 0, 1);
        $brands = $ome_brand_obj->getList('brand_name', array('brand_id' => $material_ext[0]['brand_id']));

        $tmp_array = array();
        $tmp_array['brand_id'] = $material_ext[0]['brand_id'];
        $tmp_array['brand_name'] = $brands[0]['brand_name'];
        $tmp_array['specifications'] = $material_ext[0]['specifications'];

        return $tmp_array;
    }
}