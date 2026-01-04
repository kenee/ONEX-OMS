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


class tgstockcost_costschema
{
  function get_schema()
  {
      $db['branch_product']=array (
        'columns' =>
        array (
			'id' => 
				array (
				'type' => 'number',
				'required' => true,
				'pkey' => true,
				'extra' => 'auto_increment',
				'editable' => false,
			),
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

          'store' =>
          array (
            'label' => '库存数',
            'editable' => false,
            'in_list' => true,
            'default_in_list'=>true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'orderby'=>false,
          ),
          'unit_cost' =>
          array (
            'label' => '单位平均成本',
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
            'label' => '库存成本',
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