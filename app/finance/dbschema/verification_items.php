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

$db['verification_items']=array (
  'columns' => 
  array (
    'item_id' => 
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
    ),
    'log_id' => 
    array (
      'type' => 'int',
      'required' => true,
      'editable' => false,
    ),
    'bill_id' => 
    array (
      'type' => 'int',
      'required' => true,
    ),
    'bill_bn' =>
    array (
      'type' => 'varchar(32)',
      'required' => true,
      'comment' => '单据编号'
    ),
    'type' => 
    array (
      'type' => 'int',
      'required' => true,
      'comment' => '单据号类型 实收单据（0） 应收单据（1）',
    ),
    'money' =>
    array (
      'type' => 'money',
      'comment' => '核销金额'
    ),
    'trade_time' => 
    array (
      'type' => 'time',
      'required'=>true,
      'editable' => false,
      'comment'=>'账单完成时间',
    ),
  ),
  'index'=>array(
    'ind_log_id' =>
    array (
        'columns' =>
        array (
          0 => 'log_id',
        ),
    ),
    'ind_bill_id' =>
    array (
        'columns' =>
        array (
          0 => 'bill_id',
        ),
    ),
    'ind_type' =>
    array (
        'columns' =>
        array (
          0 => 'type',
        ),
    ),
    'ind_money' =>
    array (
        'columns' =>
        array (
          0 => 'money',
        ),
    ),
    'ind_trade_time' =>
    array (
        'columns' =>
        array (
          0 => 'trade_time',
        ),
    ),
  ), 
  'comment' => '核销日志明细',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);