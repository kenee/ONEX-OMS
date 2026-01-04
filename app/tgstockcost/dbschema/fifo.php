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

$db['fifo']=array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'bigint unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
    ),
	'branch_id' => 
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'editable' => false,
    ),
    'product_id' => 
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'editable' => false,
    ),
    'product_bn' => 
    array (
      'type' => 'varchar(30)',
      'label' => '货品编码',
      'width' => 85,
      'searchtype' => 'has',
      'filtertype' => 'normal',
      'filterdefault' => true,
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
	'stock_bn' => 
    array (
      'type' => 'varchar(30)',
      'label' => '单据流水号',
      'width' => 85,
      'searchtype' => 'has',
      'filtertype' => 'normal',
      'filterdefault' => true,
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'in_num' => 
    array (
      'type' => 'mediumint',
	   'label' => '入库数量',
      'default' => 0,
      'editable' => false,
    ),
	'out_num' => 
    array (
      'type' => 'mediumint',
	   'label' => '已出库数量',
      'default' => 0,
      'editable' => false,
    ),
	'current_num' => 
    array (
      'type' => 'mediumint',
	   'label' => '当前在库数量',
      'default' => 0,
      'editable' => false,
    ),
	'bill_bn' => 
    array (
      'type' => 'varchar(30)',
      'label' => '原始单据号',
      'width' => 85,
      'searchtype' => 'has',
      'filtertype' => 'normal',
      'filterdefault' => true,
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'current_unit_cost' =>
    array(
       'type' => 'money',
	   'label' => '当前单位成本',
       'default' => 0,
    ),
	'current_inventory_cost' =>
    array(
       'type' => 'money',
	   'label' => '当前库存成本',
       'default' => 0,
    ),
	'is_sart' =>
    array(
       'type' => 'tinyint(1)',
	   'label' => '是否期初',
       'default' => 0,
    ),
  ),
  'index' =>
  array (
    'ind_product_id' =>
    array (
        'columns' =>
        array (
          0 => 'product_id',
        ),
    ),
	'ind_branch_id' =>
    array (
        'columns' =>
        array (
          0 => 'branch_id',
        ),
    ),
  ),
  'comment' => '出入库成本流水表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);