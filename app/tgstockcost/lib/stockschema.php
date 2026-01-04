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


class tgstockcost_stockschema
{
  function get_schema()
  {
      $db['branch_product']=array (
        'columns' =>
        array (
          'product_bn' =>
          array (
            'label' => '货号',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
			'searchtype' => 'has',
			'filterdefault' => true,
            'filtertype' => 'normal',
            'filterdefault' => true,
          ),
          'product_name' =>
          array (
            'label' => '名称',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'orderby'=>false,
          ),
          'type_name' =>
          array (
            'label' => '商品类型',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'orderby'=>false,
          ),
		  'brand_name' =>
          array (
            'label' => '品牌',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'orderby'=>false,
          ),
		  'spec_info' =>
          array (
            'label' => '规格',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'orderby'=>false,
          ),
		  'unit' =>
          array (
            'label' => '单位',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'orderby'=>false,
          ),
		  'start_nums' =>
          array (
            'label' => '期初数量',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'orderby'=>false,
          ),
		  'start_unit_cost' =>
          array (
            'label' => '期初单位成本',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'orderby'=>false,
          ),
		  'start_inventory_cost' =>
          array (
            'label' => '期初库存成本',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'orderby'=>false,
          ),
		  'in_nums' =>
          array (
            'label' => '入库数量',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'orderby'=>false,
          ),
		  'in_unit_cost' =>
          array (
            'label' => '入库单位成本',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'orderby'=>false,
          ),
		  'in_inventory_cost' =>
          array (
            'label' => '入库库存成本',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'orderby'=>false,
          ),
		  'out_nums' =>
          array (
            'label' => '出库数量',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'orderby'=>false,
          ),
		  'out_unit_cost' =>
          array (
            'label' => '出库单位成本',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'orderby'=>false,
          ),
		  'out_inventory_cost' =>
          array (
            'label' => '出库库存成本',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'orderby'=>false,
          ),
          'store' =>
          array (
            'label' => '结存数量',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'orderby'=>false,
          ),
          'unit_cost' =>
          array (
            'label' => '结存单位成本',
		   'type'=>'money',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'orderby'=>false,
          ),
          'inventory_cost' =>
          array (
            'label' => '结存库存成本',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'orderby'=>false,
			'type'=>'money',
          ),
        ),
       // 'engine' => 'innodb',
        //'version' => '$Rev:  $',
      );
      return $db['branch_product'];
  }
}