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

$db['branch_pos']=array (
  'columns' => 
  array (
    'pos_id' => 
    array (
      'type' => 'number',
      'required' => true,
      'pkey' => true,
      'editable' => false,
      'extra' => 'auto_increment',
    ),
    'store_position' =>
    array (
      'type' => 'varchar(100)',
      'editable' => false,
      'required' => true,
      'label' => '货位',
      'in_list' => true,
      'default_in_list' => true,
      'searchtype' => 'has',
      'filtertype' => 'normal',
      'filterdefault' => true,
    ),
    'branch_id' =>
    array (
      'type' => 'table:branch@ome',
      'required' => true,
      'editable' => false,
      'label' => '仓库',
      'in_list' => true,
      'default_in_list' => true,
      'searchtype' => 'nequal',
      'filtertype' => 'normal',
      'filterdefault' => true,
    ),
    'disabled' =>
    array (
      'type' => 'bool',
      'required' => true,
      'default' => 'false',
      'editable' => false,
    ),
    'stock_threshold' =>
    array (
      'type' => 'number',
      'required' => false,
      'default' => 0,
      'editable' => false,
    ),
  ),
  'index' =>
  array (
    'ind_branch_pos' =>
    array (
      'columns' =>
      array (
        0 => 'branch_id',
        1 => 'store_position'
      ),
      'prefix' => 'unique',
    ),
    'ind_store_position' =>
    array (
      'columns' =>
      array (
        0 => 'store_position',
      ),
    ),
    'ind_pos_id' =>
    array (
        'columns' =>
        array (
          0 => 'pos_id',
        ),
    ),
  ),
  'comment' => '发货点仓库货位表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);