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

$db['delivery_code']=array (
  'columns' =>
  array (
    'delivery_bn' =>
    array (
      'type' => 'varchar(32)',
      'comment' => '发货单单号',
      'required' => true,
      'editable' => false,
      'pkey' => true,
    ),
    'code' =>
    array (
      'type' => 'mediumint(6) unsigned',
      'comment' => '提货校验码',
      'required' => true,
      'editable' => false,
    ),
    'status' =>
    array (
      'type' => 'tinyint(1)',
      'required' => true,
      'editable' => false,
      'label' => '使用状态',
      'default' => 2,
    ),
    'create_time' =>
    array (
      'type' => 'time',
      'comment' => '生成时间',
      'required' => true,
      'editable' => false,
    ),
  ),
  'index' =>
  array (
    'ind_code' =>
    array (
      'columns' =>
      array (
        0 => 'code',
      ),
      'prefix' => 'unique',
    ),
  ),
  'engine' => 'innodb',
  'version' => '$Rev:  $',
  'comment' => '门店提货校验码关联表'
);