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

class o2o_mdl_product_store extends dbeav_model{
    
    var $has_export_cnf = true;
    var $export_name = '门店库存';
    
    //扩展字段先定义
    function extra_cols(){
        return array(
            'column_store_name' => array('label'=>'关联门店','width'=>'150','func_suffix'=>'store_name',"order"=>"7"),
            'column_specifications' => array('label'=>'规格','width'=>'120','func_suffix'=>'specifications',"order"=>"6"),
            'column_type_name' => array('label'=>'分类','width'=>'100','func_suffix'=>'type_name',"order"=>"5"),
            'column_brand_name' => array('label'=>'品牌','width'=>'120','func_suffix'=>'brand_name',"order"=>"4"),
            'column_material_bn' => array('label'=>'基础物料编码','width'=>'120','func_suffix'=>'material_bn',"order"=>"3"),
            'column_material_name' => array('label'=>'基础物料名称','width'=>'260','func_suffix'=>'material_name',"order"=>"2"),
        );
    }
    
    function extra_store_name($rows){
        return kernel::single('o2o_extracolumn_productstore_storename')->process($rows);
    }
    
    function extra_material_name($rows){
        return kernel::single('o2o_extracolumn_productstore_materialname')->process($rows);
    }
    
    function extra_material_bn($rows){
        return kernel::single('o2o_extracolumn_productstore_materialbn')->process($rows);
    }
    
    function extra_specifications($rows){
        return kernel::single('o2o_extracolumn_productstore_specifications')->process($rows);
    }
    
    function extra_brand_name($rows){
        return kernel::single('o2o_extracolumn_productstore_brandname')->process($rows);
    }
    
    function extra_type_name($rows){
        return kernel::single('o2o_extracolumn_productstore_typename')->process($rows);
    }
    
}