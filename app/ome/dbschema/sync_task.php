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

$db['sync_task']=array (
  'columns' => 
  array (
    'sync_task_id' => 
    array (
      'type' => 'number',
      'extra' => 'auto_increment',
      'required' => true,
      'pkey' => true,
      'editable' => false,
    ),
    'params' =>
    array (
      'type' => 'text',
      'editable' => false,
    ),
    'action' =>
    array (
      'type' => 'varchar(50)',
      'editable' => false,
    ),
    'retry' =>
    array (
      'type' => 'number',
      'editable' => false,
    ),
  ),
  
  'comment' => '同步任务',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);