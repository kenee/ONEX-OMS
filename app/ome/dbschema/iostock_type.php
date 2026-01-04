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

$db['iostock_type']=array (
  'columns' =>
  array (
    'type_id' =>
    array (
      'type' => 'number',
      'required' => true,
      'pkey' => true,
   ),
    'type_name' =>
    array (
     'is_title' => true,
      'editable' => false,
      'type' => 'varchar(32)',
      'required' => true,
      'comment' => '类型名称',
      'label'=>'类型名称',
      'is_title' => true,
       'in_list' => true,
      'default_in_list' => true,
    ),
  ),
  'comment' => '出入库类型',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);