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

$db['concurrent']=array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'varchar(32)',
      'required' => true,
      'pkey' => true,
      'editable' => false,
    ),
    'type' =>
    array (
      'type' => 'varchar(30)',
      'editable' => false,
      'pkey' => true,
      'required' => true,
    ),
    'current_time' =>
    array (
      'type' => 'int unsigned',
    ),
  ),
  
  'index' =>
  array (
    'ind_current_time' =>
    array (
        'columns' =>
        array (
          0 => 'current_time',
        ),
    ),
  ),
  'comment' => '防止重复记录表',
  'engine' => 'innodb',
  'version' => '$Rev: 41996 $',
);