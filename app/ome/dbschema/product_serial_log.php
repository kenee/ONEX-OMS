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

$db['product_serial_log']=array (
  'columns' => 
  array (
    'log_id' => 
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
    ),
    'item_id' => 
    array (
      'type' => 'table:product_serial@ome',
      'required' => true,
      'editable' => false,
    ),
    'act_type' => 
    array (
      'type' => 'tinyint',
      'label' => '操作类型',
      'required' => true,
      'default' => 0,
      'editable' => false,
    ),
    'act_time' => 
    array (
      'type' => 'time',
      'label' => '操作时间',
      'width' => 130,
      'editable' => false,
      'in_list' => true,
    ),
    'act_owner' => 
    array (
      'type' => 'table:users@desktop',
      'label' => '操作人',
      'required' => true,
      'editable' => false,
    ),
    'bill_type' => 
    array (
      'type' => 'tinyint',
      'label' => '单据类型',
      'required' => true,
      'default' => 0,
      'editable' => false,
    ),
    'bill_no' =>
    array (
      'type' => 'varchar(30)',
      'label' => '单据编号',
      'required' => true,
      'default' => '',
      'editable' => false,
      'is_title' => true,
    ),
    'serial_status' =>
    array (
      'type' => 'tinyint',
      'default' => '0',
      'required' => true,
      'label' => '唯一码状态',
      'width' => 75,
      'editable' => false,
    ),
  ),
  'index' => 
  array (
    'ind_bill_no' => 
    array (
        'columns' =>
        array (
          0 => 'bill_no',
        ),
    ),
  ),
  'comment' => '唯一码商品日志表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);