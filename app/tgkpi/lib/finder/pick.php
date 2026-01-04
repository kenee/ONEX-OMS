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

class tgkpi_finder_pick {
	var $column_ident = "打印批次号";
    var $column_ident_width = "120";
    var $addon_cols = "print_ident,print_ident_dly";
    function column_ident($row) {
        $identStr = '';
        if($row[$this->col_prefix.'print_ident']){
            $identStr .= $row[$this->col_prefix.'print_ident']."_".$row[$this->col_prefix.'print_ident_dly'];
        }
        return $identStr;
    }
    var $column_product_name = "商品名称";
    var $column_product_name_width = "120";
    function column_product_name($row)
    {
        $basicMaterialLib    = kernel::single('material_basic_material');
        $bMaterialRow    = $basicMaterialLib->getBasicMaterialBybn($row['product_bn']);
        
        return $bMaterialRow['material_name'];
    }
    var $column_spec_info = "规格";
    var $column_spec_info_width = "120";
    function column_spec_info($row)
    {
        $basicMaterialLib    = kernel::single('material_basic_material');
        $bMaterialRow    = $basicMaterialLib->getBasicMaterialBybn($row['product_bn']);
        
        return $bMaterialRow['specifications'];
    }
}