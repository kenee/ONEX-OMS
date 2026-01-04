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

$db['region_rule']=array (
  'columns' =>
  array (
  'id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'editable' => false,
      'extra' => 'auto_increment',
    ),

    'item_id' =>
    array (
      'type' => 'int',
      'required' => true,
      'default' => 0,
      'editable' => false,
      'comment' => '项目ID',
    ),

    'region_id' =>
    array (
      'type' => 'int',
      'required' => true,
      'default' => 0,
      'editable' => false,
      'comment' => '区域ID',
    ),
    'region_grade' =>
        array(
            'type' => 'number',
            'editable' => false,
            'comment' => '区域级别',
        ),

 'obj_id' =>
    array (
      'type' => 'int',
      'required' => true,
      'default' => 0,
      'editable' => false,
      'comment' => '对象ID',
    ),
),
 'index' =>array (
 'ind_region_id' =>
    array (
      'columns' =>
      array (
        0 => 'region_id',
      ),
    ),

 ),
  'comment' => '区域规则',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);