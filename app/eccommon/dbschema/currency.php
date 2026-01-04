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


$db['currency']=array (
  'columns' =>
  array (
    'cur_id' =>
    array (
      'type' => 'int(8)',
      'required' => true,
      'pkey' => true,
      'label' => '货币ID',
      'editable' => false,
      'extra' => 'auto_increment',
      'in_list' => false,
    ),
    'cur_name' =>
    array (
      'type' => 'varchar(20)',
      'required' => true,
      'default' => '',
      'label' => '货币名称',
      'editable' => true,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'cur_sign' =>
    array (
      'type' => 'varchar(5)',
      'label' => '货币符号',
      'editable' => true,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'cur_code' =>
    array (
      'type' => 'varchar(8)',
      'required' => true,
      'default' => '',
      'label' => '货币代码',
      'editable' => false,
      'in_list' => true,
      'is_title' => true,
      'default_in_list' => true,
    ),


    'cur_rate' =>
    array (
      'type' => 'decimal(10,4)',
      'default' => '1.0000',
      'required' => true,
      'label' => '汇率',
      'editable' => true,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'cur_default' =>
    array (
      'type' => 'bool',
      'default' => 'false',
      'required' => true,
      'label' => '默认货币',
      'in_list' => true,
      'default_in_list' => true,
    ),
  ),
  'label' => '货币',
  'index' =>
  array (
    'uni_ident_type' =>
    array (
      'columns' =>
      array (
        0 => 'cur_code',
      ),
      'prefix' => 'UNIQUE',
    ),
  ),
  'comment' => '电商商务通用应用货币表', 
  'version' => '$Rev: 40654 $',
);
