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

$db['operation_log']=array (
  'columns' => 
  array (
    'log_id' => 
    array (
      'type' => 'int unsigned',
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
      'comment' => '日志ID',
    ),
  'op_id' => 
    array (
      'type' => 'table:account@pam',
      'editable' => false,
      'required' => true,
      'comment' => '操作员ID',
    ),
    'op_name' =>
    array (
      'type' => 'varchar(30)',
      'editable' => false,
       'in_list' => true,
        'default_in_list' => true,
        'label' => '操作人',
    ),
    'operate_time' => 
    array (
      'type' => 'time',
      'required' => true,
      'editable' => false,
       'in_list' => true,
        'default_in_list' => true,
         'label' => '时间',
    ),
    'archive_time' => 
    array (
    'type' => 'time',
    'editable' => false,
    'label' => '归档时间',
     'in_list' => true,
     'default_in_list' => true,
    ),
    'memo' => 
    array (
      'type' => 'text',
      'editable' => false,
       'in_list' => true,
        'default_in_list' => true,
         'label' => '内容',
    ),
    'ip' => 
    array (
      'type' => 'varchar(15)',
      'editable' => false,
       'in_list' => true,
        'default_in_list' => true,
         'label' => 'IP',
    ),
  ),
  'comment' => '归档操作员操作记录表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);