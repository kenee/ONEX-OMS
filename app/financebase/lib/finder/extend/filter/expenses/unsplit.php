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

class financebase_finder_extend_filter_expenses_unsplit{
    function get_extend_colums(){
        // 获取所有店铺数据
        $shopName = array_column(app::get('ome')->model('shop')->getList('name,shop_id'),'name','shop_id');
        
        // 获取费用类别数据
        $billCategory = app::get('financebase')->model('expenses_rule')->getBillCategory();
        $billCategoryData = array();
        foreach($billCategory as $category) {
            $billCategoryData[$category['bill_category']] = $category['bill_category'];
        }
        
        //dbschema
        $db['bill']=array (
            'columns' => array (
                'shop_id' => array(
                    'type'          => $shopName,
                    'label'         => '来源店铺',
                    'width'         => 100,
                    'editable'      => false,
                    'in_list'       => true,
                    'filtertype'    => 'fuzzy_search_multiple',
                    'filterdefault' => true,
                    'order'=>1,
                ),
                'bill_category' => array(
                    'type'          => $billCategoryData,
                    'label'         => '具体类别',
                    'width'         => 130,
                    'editable'      => false,
                    'in_list'       => true,
                    'default_in_list' => false,
                    'filtertype'    => 'normal',
                    'filterdefault' => true,
                    'order'=>60,
                ),
            )
        );
        return $db;
    }
} 