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

$db['expenses_split']=array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'bigint unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
    ),
    'bm_id' => array(
      'type' => 'table:basic_material@material',
      'label' => '基础物料名称',
      'width' => 120,
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
      'order'=>5,
    ),
    'bill_id' => array(
      'type' => 'table:bill@financebase',
      'label' => '业务流水号',
      'width' => 180,
      'in_list' => true,
      'default_in_list' => true,
      'order'=>10,
    ),
    'parent_id' => array(
      'type' => 'bigint unsigned',
      'label' => '来源ID',
      'width' => 130,
      'order'=>15,
    ),
    'parent_type' => array(
      'type' => 'varchar(32)',
      'label' => '来源类型',
      'width' => 130,
      'order'=>20,
    ),
    'trade_time' => array(
        'type' => 'time',
        'label' => '账单时间',
        'width' => 150,
        'filtertype' => 'normal',
        'filterdefault' => true,
        'editable' => false,
        'in_list' => true,
        'default_in_list' => false,
        'order'=>25,
    ),
    'split_time' => array(
        'type' => 'time',
        'label'=>'拆分时间',
        'width' => 150,
        'filtertype' => 'normal',
        'filterdefault' => true,
        'editable' => false,
        'in_list' => true,
        'default_in_list' => false,
        'order'=>25,
    ),
    'money' => array(
          'type' => 'decimal(20,5)',
          'required' => true,
          'label'=>'分摊费用',
          'width' => 100,
          'editable' => false,
          'in_list' => true,
          'default_in_list' => true,
          'order'=>35,
    ),
    'bill_category' => array(
          'type' => 'varchar(50)',
          'label' => '具体类别',
          'width' => 100,
          'editable' => false,
          'in_list' => true,
          'default_in_list' => true,
          'order'=>30,
    ),
    'split_type' => array(
          'type' => 'varchar(32)',
          'label' => '拆分维度',
          'width' => 100,
          'editable' => false,
          'in_list' => true,
          'default_in_list' => false,
          'order'=>40,
    ),
    'split_rule' => array(
          'type' => 'varchar(32)',
          'label' => '拆分规则',
          'width' => 100,
          'editable' => false,
          'in_list' => true,
          'default_in_list' => false,
          'order'=>45,
    ),
    'split_status' => array(
          'type' => array(
            '0'=>'拆分项',
            '1'=>'调整项',
            '2'=>'红冲项',
          ),
          'label' => '拆分状态',
          'width' => 100,
          'default' => '0',
          'editable' => false,
          'in_list' => true,
          'default_in_list' => false,
          'order'=>45,
    ),
    'porth' => array(
          'type' => 'money',
          'label' => '拆分贡献比',
          'default' => 0,
          'editable' => false,
          'in_list' => true,
          'default_in_list' => false,
          'order'=>50,
    ),
    'shop_id' => array(
            'type' => 'varchar(32)',
            'editable' => false,
            'label' => '来源店铺',
            'comment'=>'来源店铺',
            'width' => 100,
            'order'=>55,
    ),
    'confirm_status' => array(
            'type' => array(
                '0' => '否',
                '1' => '是'
            ),
            'label' => '是否对账',
            'default' => '0',
            'width' => 80,
            'editable' => false,
            'in_list' => true,
            'default_in_list' => true,
            'order' => 60,
    ),
  ),
  'index' => array(
    'ind_trade_time' => array('columns' => array(0 => 'trade_time')),
    'ind_split_time' => array('columns' => array(0 => 'split_time')),
    'ind_bill_category' => array('columns' => array(0 => 'bill_category')),
   ),
  'comment' => '费用拆分表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);
