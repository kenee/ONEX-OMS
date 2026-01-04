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

$db['authorize']=array (
  'columns' =>
  array (
    'account_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'editable' => false,
    ),
    'account_type' =>
    array(
        'type' => 'varchar(30)',
        'required' => true,
        'label' => '账户类型',
        'editable' => false,
    ),
    'uname' =>
    array(
        'type' => 'varchar(100)',
        'required' => true,
        'label' => '用户名',
        'editable' => false,
        'in_list' => false,
    ),
    'source' =>
    array(
        'type' => 'varchar(30)',
        'required' => false,
        'label' => '来源',
        'editable' => false,
        'in_list' => false,
    ),
    'code' =>
    array(
        'type' => 'varchar(32)',
        'required' => true,
        'label' => 'code',
        'editable' => false,
        'in_list' => false,
        'default' => '',
    ),
    'disabled' =>
    array (
      'type' => 'bool',
      'default' => 'false',
      'comment' => '无效',
      'editable' => false,
      'label' => '无效',
      'in_list' => false,
    ),
    'bind_time' =>
    array (
      'type' => 'time',
      'label' => '绑定时间',
      'editable' => false,
    ),
  ),
  'index' =>
  array (
          
  ),
  'comment' => '第三方免登信息表',
  'engine' => 'innodb',
  'version' => '$Rev: 41996 $',
);