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

$db['stockdump_items']=array (
  'columns' =>
  array (
    'item_id' =>
    array (
      'type' => 'number',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
    ),
    'stockdump_id' =>
    array (
      'type' => 'table:stockdump',
      'required' => true,
      'label' => 'ID'
    ),
    'stockdump_bn' =>
    array (
      'type' => 'varchar(20)',
      'required' => true,
      'label' => '编号',
    ),
    'product_id' =>
    array (
      'type' => 'table:products@ome',
      'required' => true,
      'editable' => false,
    ),
   
   'stockdump_date' =>
    array (
      'type' => 'time',
      'label' => '生成时间',
    ),
    'bn' =>
    array (
      'type' => 'varchar(30)',
      'label' => '货号',
    ),
    'product_name' =>
    array (
      'type' => 'varchar(200)',
      'label' => '货品名称',
    ),
    'num' =>
    array (
      'type' => 'number',
      'label' => '数量',
	  'default' => 0,
    ),
    'in_nums' =>
    array (
      'type' => 'number',
      'label' => '已出入库数量',
	  'default' => 0,
    ),
   'defective_num' =>
    array (
      'type' => 'number',
      'label' => '不良品数量',
	  'default' => 0,
    ),
    'appro_price'=>
    array(
        'type' => 'money',
        'label' => '出入库价格',
    ),
  ),
  'index' => array(
        'idx_appropriation_bn' => array(
            'columns' => array('stockdump_bn','bn')
        ),
        
    ),
  'comment' => '库存出入库单明细',
  'engine' => 'innodb',
  'version' => '$Rev: 44513 $',
);
