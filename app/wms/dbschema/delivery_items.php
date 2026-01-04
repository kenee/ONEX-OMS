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

$db['delivery_items']=array (
  'columns' =>
  array (
    'item_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
    ),
    'outer_item_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'editable' => false,
    ),
    'delivery_id' =>
    array (
      'type' => 'table:delivery@wms',
      'required' => true,
      'default' => 0,
      'editable' => false,
    ),
    'product_id' =>
    array (
      'type' => 'table:products@ome',
      'required' => true,
      'default' => 0,
      'editable' => false,
    ),
    'use_expire' =>
    array (
      'type' => 'tinyint(1)',
      'label' => '保质期开关',
      'editable' => false,
      'default'         => 2,
    ),
    'shop_product_id' =>
    array (
      'type' => 'varchar(50)',
      'editable' => false,
    ),
    'bn' =>
    array (
      'type' => 'varchar(30)',
      'editable' => false,
      'is_title' => true,
    ),
    'product_name' =>
    array (
      'type' => 'varchar(200)',
      'editable' => false,
    ),
    'number' =>
    array (
      'type' => 'number',
      'required' => true,
      'default' => 0,
      'editable' => false,
    ),
    'verify' =>
    array (
      'type' => 'bool',
      'required' => true,
      'default' => 'false',
      'editable' => false,
    ),
    'verify_num' =>
    array (
      'type' => 'number',
      'required' => true,
      'default' => 0,
      'editable' => false,
    ),
    'price' =>
    array (
      'type' => 'money',
      'default' => '0',
      'required' => true,
      'editable' => false,
    ),
    'sale_price' =>
    array (
      'type' => 'money',
      'default' => '0',
      'required' => true,
      'editable' => false,
    ),
    'pmt_price' =>
    array (
      'type' => 'money',
      'default' => '0',
      'required' => true,
      'editable' => false,
    ),
  ),
  'comment' => '发货单明细表',  
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);