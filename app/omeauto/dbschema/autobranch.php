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

$db['autobranch']=array (
  'columns' => 
  array (
    'tid' => 
    array (
      'type' => 'number',
      'required' => true,
      'pkey' => true,
      ),
    'bid' => 
    array (
      'type' => 'mediumint',
      'required' => true,
      'pkey' => true,
    ),
   'weight'=>array(
   'type' => 'tinyint',
   'default'=>0,

   ),
   'is_default' =>
    array (
      'type' => 'intbool',
      'default' => '0',
      'required' => true,
      'editable' => false,
    ),
  ),
  'comment' => '自动审单仓库规则',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);