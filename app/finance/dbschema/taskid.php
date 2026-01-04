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

$db['taskid']=array (
  'comment' => '交易任务号',
  'columns' => 
  array (
    'task_id' => 
    array (
      'type' => 'varchar(32)',
      'required' => true,
      'pkey' => true,
      'editable' => false,
      'label' => '任务号',
    ),
    'node_id' => 
    array (
      'type' => 'varchar(20)',
      'pkey' => true,
      'editable' => false,
      'label' => '节点ID',
    ),
    'node_name' => 
    array (
      'type' => 'varchar(32)',
      'editable' => false,
      'label' => '节点名称',
    ),
    'taskid_time' =>
    array (
      'type' => 'varchar(25)',
      'label' => '任务创建时间',
      'editable' => false,
    ),
    'start_time' =>
    array (
      'type' => 'varchar(25)',
      'label' => '单据开始时间',
      'editable' => false,
    ),
    'end_time' =>
    array (
      'type' => 'varchar(25)',
      'label' => '单据结束时间',
      'editable' => false,
    ),
    'createtime' =>
    array (
      'type' => 'time',
      'label' => '记录创建时间',
      'editable' => false,
    ),
  ),
  'engine' => 'innodb',
  'version' => '$Rev: 44513 $',
);
