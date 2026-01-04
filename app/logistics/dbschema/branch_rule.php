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

$db['branch_rule']=array (
  'columns' =>
  array (
    'branch_id' =>
    array (
      'type' => 'table:branch@ome',
      'editable' => false,
      'label' => '仓库',
      'width' => 110,
      'pkey' => true,
      'filtertype' => 'normal',
      'filterdefault' => true,
      'in_list' => true,
    ),
    'type' =>
    array (
      'type' =>
      array (
        'custom' => '自定义',
        'other' => '复用',
        ),
      'default' => 'custom',
      'required' => true,
      'label' => '规则类型',
      'width' => 70,
      'editable' => false,

    ),
    'parent_id' =>
    array (
      'type' => 'bigint unsigned',
      'editable' => false,
      'default' => 0,
      'comment' => '父ID',
    ),

     'last_modified' =>
    array (
      'label' => '最后更新时间',
      'type' => 'last_modify',
      'width' => 130,
      'editable' => false,
      'in_list' => true,
    ),


),
 'index' => array (
 'ind_branch_id' =>
    array (
      'columns' =>
      array (
        0 => 'branch_id',
      ),
      'prefix' => 'unique',
    ),

 ),
  'comment' => '仓库规则',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);