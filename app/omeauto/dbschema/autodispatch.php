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

$db['autodispatch']=array (
  'columns' => 
  array (
    'oid' => 
    array (
      'type' => 'number',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
    ),
    'name' => 
    array (
      'type' => 'varchar(200)',
      'required' => true,
      'editable' => false,
      'is_title' => true,
      'searchtype' => 'has',
      'filtertype' => 'normal',
      'filterdefault' => true,
      'in_list' => true,
      'default_in_list' => true,
      'width' => 130,
      'label' => '规则名称',
    ),
    'config' =>
    array (
      'type' => 'serialize',
      'editable' => false,
    ),
    'memo' =>
    array (
      'type' => 'text',
      'editable' => false,
    ),
    'disabled' => 
    array (
      'type' => 'bool',
      'required' => true,
      'editable' => false,
      'default' => 'false',
    ),
    'defaulted' => 
    array (
      'type' => 'bool',
      'required' => true,
      'editable' => false,
      'default' => 'false',
    ),
    'group_id' => 
    array (
      'type' => 'table:groups@ome',
      'editable' => false,
      'label' => '订单确认组',
      'in_list' => true,
      'default_in_list' => true,
    ),
    'op_id' => 
    array (
      'type' => 'table:account@pam',
      'editable' => false,
      'label' => '订单确认员',
      'in_list' => true,
      'default_in_list' => true,
    ),
    'org_id' =>
    array (
      'type' => 'table:operation_organization@ome',
      'label' => '运营组织',
      'editable' => false,
      'width' => 60,
      'filtertype' => 'normal',
      'filterdefault' => true,
      'in_list' => true,
      'default_in_list' => true,
    ),
  ),
  'comment' => '自动分配规则', 
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);