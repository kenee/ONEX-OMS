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


$db['analysis']=array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'number',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
    ),
    'service' => 
    array (
      'type' => 'varchar(100)',
      'required' => true,
      'comment' => '报表服务名',
    ),
    'interval' => 
    array (
      'type' => 
          array (
            'hour' => 'hour',
            'day' => 'day',
          ),
      'required' => true,
      'comment' => '间隔时间',
    ),
    'modify' => 
    array (
      'type' => 'time',
      'required' => true,
      'default' => 0,
      'comment' => '修改时间',
    ),
  ),
  'comment' => '电商商务通用应用分析',
  'engine' => 'innodb',
  'ignore_cache' => true,
);
