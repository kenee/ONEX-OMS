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

$db['payment_cfg']=array (
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
    'custom_name' => 
    array (
      'type' => 'varchar(100)',
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
      'is_title' => true,
      'label' => '支付方式名',
      'searchtype' => 'has',
      'filtertype' => 'normal',
      'filterdefault' => true,
    ),
    'pay_bn' =>
    array (
      'type' => 'varchar(255)',
      'editable' => false,
      'label' => '支付编号',
    ),
    'des' => 
    array (
      'type' => 'longtext',
      'editable' => false,
    ),
    'pay_type' =>
    array (
      'type' => 'varchar(100)',
      'default' => 'online',
      'width' => 75,
      'editable' => false,
      'label' => '支付类型',
      'in_list' => true,
      'default_in_list' => true,
    ),
    'disabled' => 
    array (
      'type' => 'bool',
      'required' => true,
      'default' => 'false',
      'editable' => false,
    ),
    'create_time' => array(
        'type' => 'time',
        'label' => '新建时间',
        'width' => 120,
        'in_list' => true,
        'order' => 11,
    ),
    'last_modify' => array(
        'type' => 'last_modify',
        'label' => '最后更新时间',
        'width' => 120,
        'in_list' => true,
        'order' => 11,
    ),
  ),
  'index' => 
  array (
    'uni_pay_bn' => 
    array (
      'columns' => 
      array (
        0 => 'pay_bn',
      ),
      'prefix' => 'UNIQUE',
    ),
  ),
  'comment' => '支付单辅助表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);