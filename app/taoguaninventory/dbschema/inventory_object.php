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

$db['inventory_object']=array (
  'columns' =>
  array (
'obj_id' =>
     array (
      'type' => 'number',
     'required' => true,
     'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
    ),
    'oper_id' => array(
        'type' => 'number',
         'label'=>'操作人ID'
    ),
    'oper_name'=>array(
        'type'=>'varchar(30)',
         'label'=>'操作人名称'
    ),
    'oper_time'=>array(
        'type'=>'time',
         'label'=>'操作时间'
    ),
    'item_id'=>array(
         'type' => 'table:inventory_items',

    ),

    'inventory_id' =>
    array (
      'type' => 'table:inventory',
      'required' => true,
      'editable' => false,

      'label' => '盘点ID'
    ),
    'product_id' =>
    array (
      'type' => 'table:products@ome',
      'label' => '货品ID',
      'editable' => false,
    ),
    'pos_id' =>
    array (
      'type' => 'number',
      'label' => '货位ID',
      'editable' => false,
      'default' => 0,
    ),

    'bn' =>
    array (
      'type' => 'varchar(32)',
      'label' => '货号',
      'width' => 140,
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'barcode' =>
    array (
      'type' => 'varchar(32)',
      'label' => '条码',
      'width' => 140,
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),

    'pos_name' =>
    array (
      'type' => 'varchar(32)',
      'label' => '货位名称',
      'width' => 80,
      'editable' => false,
      'filtertype' => 'normal',
      'in_list' => true,
    ),

    'actual_num' =>
    array (
      'type' => 'number',
      'label' => '实际数量',
      'width' => 75,
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
   ),
    'storage_life_info' =>
     array (
             'type' => 'text',
             'label' => '保质期关联信息',
             'editable' => false,
    ),
  ),
  'index' =>
  array (
    'ind_bn' =>
    array (
        'columns' =>
        array (
          0 => 'bn',
        ),
    ),


  ),
  'comment' => '盘点中间表',
  'engine' => 'innodb',
  'version' => '$Rev: 44513 $',
);