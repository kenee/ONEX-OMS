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

$db['bill_op_logs']=array (
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
    'log_bn' => 
    array (
      'type' => 'varchar(32)',
      'required' => true,
      'label' => '核销流水号',
      'searchtype' => 'nequal',
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
      'editable' => false,
    ),
    'log_time' => 
    array (
      'type' => 'time',
      'required' => true,
      'label' => '记录时间',
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
      'filtertype' => 'time',
      'filterdefault' => true,
    ),
    'op_name' =>
    array (
      'type' => 'varchar(100)',
      'label' => '操作人',
      'comment' => '操作人',
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
      'editable' => false,
    ),
    'log_type' =>
    array (
      'type' => 'varchar(30)',
      'label' => '操作类型',
      'comment' => '操作类型',
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
      'editable' => false,
    ),
    'ip' => 
    array (
      'type' => 'varchar(15)',
      'editable' => false,
    ),
    'content' => 
    array (
      'type' => 'varchar(200)',
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
      'label'=>'摘要',
      'comment'=>'摘要',
    ),
  ),
  'index'=>array(
    'ind_log_bn' =>
    array (
        'columns' =>
        array (
          0 => 'log_bn',
        ),
    ),
  ),
  'comment' => '流水操作日志表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);
