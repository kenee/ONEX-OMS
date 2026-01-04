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

$db['reship_items_storagelife']=array (
  'columns' =>
  array (
    'item_storagelife_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
    ),
    'reship_id' =>
    array (
      'type' => 'table:reship@ome',
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
    'expire_bn' => 
    array (
      'type' => 'varchar(200)',
      'required' => true,
      'editable' => false,
      'label' => '保质期批次号',
    ),
    'number' => 
    array (
      'type' => 'number',
      'required' => true,
      'default' => 0,
      'editable' => false,
      'label' => '数量',
    ),
  ),
  'index' =>
  array (
    'idx_c_expire_bn' =>
    array (
      'columns' =>
      array (
        0 => 'expire_bn',
      ),
    ),
  ),
  'comment' => '退货单货品保质期批次表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);