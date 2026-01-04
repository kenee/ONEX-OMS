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

class sales_finder_delivery_order{

  
    function detail_item($delivery_id){
    
        $itemObj = app::get('sales')->model('delivery_order_item');

        $itemList = $itemObj->getlist('*',array('delivery_id'=>$delivery_id));
        $render = app::get('sales')->render();

        $sales_types      = array('product'=>'普通', 'pkg'=>'组合', 'gift'=>'赠品', 'lkb'=>'福袋', 'pko'=>'多选一','giftpackage'=>'礼盒');

        foreach($itemList as &$v){
            $v['type_name'] = $sales_types[$v['obj_type']];
            $props = app::get('sales')->model('delivery_order_item_props')->getList('props_col,props_value', ['item_detail_id'=>$v['id']]);
            $v['props'] = array_column($props, 'props_value', 'props_col');
        }
        $propsTitle = app::get('desktop')->model('customcols')->getList('*', ['tbl_name'=>'sdb_sales_delivery_order_item']);
        $render->pagedata['propsTitle'] = $propsTitle;
    
        $render->pagedata['itemList'] = $itemList;
        
        $render->display('sales/delivery_item.html');


    }
}
?>