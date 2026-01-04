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

$db['inventory_items']=array (
  'columns' =>
  array (
    'item_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
    ),
    'inventory_id' =>
    array (
      'type' => 'table:inventory@console',
      'required' => true,
      'label' => '盘点单编号',
      'width' => 100,
      'in_list' => true,
    ),
    'product_id' =>
    array (
      'type' => 'table:products@ome',
      'required' => true,
    ),
    'bn' =>
    array (
      'type' => 'varchar(50)',
      'required' => true,
      'label' => '货号',
      'in_list' => true,
      'default_in_list' => true,
    ),
    'name' =>
    array (
      'type' => 'varchar(100)',
      'required' => false,
      'label' => '货品名称',
      'in_list' => true,
      'default_in_list' => true,
    ),
    'quantity' =>
    array (
      'type' => 'mediumint',
      'default' => 0,
      'required' => true,
      'label' => '盘点数量',
      'in_list' => true,
      'default_in_list' => true,
    ),
    'type' =>
    array (
      'type' => array(
        '1' => '盘盈',
        '2' => '盘亏',
        '3'=>'期初',
      ),
      'required' => true,
      'label' => '盘点盈亏',
      'in_list' => true,
      'default_in_list' => true,
    ),
    'memo' =>
    array (
      'type' => 'text',
      'label' => '备注',
      'width' => 150,
      'in_list' => true,
    ),
    'total_qty' =>
        array (
            'type' => 'mediumint',
            'default' => 0,
            'label' => '全量库存',
            'in_list' => true,
            'default_in_list' => true,
        ),
  ),
  'comment' => '盘点申请表',
  'engine' => 'innodb',
  'version' => '$Rev: 44513 $',
);