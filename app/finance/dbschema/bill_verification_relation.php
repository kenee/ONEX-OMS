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

$db['bill_verification_relation']=array (
  'comment' => '核销关联表',
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
    ),
    'bill_bn' => 
    array (
      'type' => 'varchar(32)',
      'label' => '流水单据号',
    ),
    'ar_bn' => 
    array (
      'type' => 'varchar(32)',
      'label' => '单据号',
    ),
    'order_bn' => 
    array (
      'type' => 'varchar(100)',
      'label' => '订单号',
    ),
    'serial_number' =>
    array (
      'type' => 'varchar(64)',
      'label'=>'业务流水号',
      ),
    'order_relation_bn' => 
    array (
      'type' => 'varchar(100)',
      'label' => '售后订单关联号',
    ),
    'money' => 
    array (
      'type' => 'money',
      'label' => '核销金额',
    ),
    'verification_time' => 
    array (
      'type' => 'time',
      'label' => '核销日期',
    ),
    'auto_flag' => 
      array (
          'type' => 'tinyint',
          'comment' => '自动核销标识 人工核销（0） 自动核销（1）',
          'editable' => false,
          'default'=>0,
          ),
      'memo' =>
      array (
          'type' => 'varchar(200)',
          'label' => '备注',
          'editable' => false,
          ),
      'verification_status' => 
      array (
          'type' => 'tinyint',
          'default' => 0,
          'label' => '核销状态',
          'comment' => '核销状态  等待核销(0)、正常核销(1)、差异核销(2)、强制核销(3) ',

      ),
  ),
  'index'=>array(
    'ind_bill_bn' =>
    array (
        'columns' =>
        array (
          0 => 'bill_bn',
        ),
    ),
    'ind_order_bn' =>
    array (
        'columns' =>
        array (
          0 => 'order_bn',
        ),
    )
  ),
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);