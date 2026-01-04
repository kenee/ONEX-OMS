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
 * 基础物料字段成本价
 * @author xiayuanjun@shopex.cn
 * @version 1.0
 */
class material_extracolumn_basicmaterial_barcode extends desktop_extracolumn_abstract implements desktop_extracolumn_interface{

    protected $__pkey = 'bm_id';
    protected $__extra_column = 'column_barcode';

    /**
     * 
     * 获取基础物料字段成本价
     * @param $ids
     * @return array $tmp_array关联数据数组
     */

    public function associatedData($ids){
        
        $basicMaterialCodeObj = app::get('material')->model('codebase');
        $barcode_lists = $basicMaterialCodeObj->getList('code,'.$this->__pkey,array($this->__pkey => $ids, 'type' => material_codebase::getBarcodeType()));

        $tmp_array= array();
        foreach($barcode_lists as $k=>$row){
             $tmp_array[$row[$this->__pkey]] = $row['code'];
        }
        return $tmp_array;
    }

}