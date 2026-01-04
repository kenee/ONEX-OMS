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

$db['branch_product_batch']=array (
  'columns' => 
  array (
    'product_id' => 
    array (
      'type' => 'table:products@ome',
      'required' => true,
      'pkey' => true,
      'editable' => false,
    ),
    'supplier_id' => 
    array (
      'type' => 'table:supplier',
      'required' => true,
      'pkey' => true,
      'editable' => false,
    ),
    'eo_id' => 
    array (
      'type' => 'table:eo',
      'required' => true,
      'pkey' => true,
      'editable' => false,
    ),
    'eo_bn' => 
    array (
      'type' => 'varchar(32)',
      'required' => true,
      'editable' => false,
    ),
    'branch_id' => 
    array (
      'type' => 'table:branch@ome',
      'required' => true,
      'editable' => false,
    ),
    'purchase_price' => 
    array (
      'type' => 'money',
      'editable' => false,
    ),
    'purchase_time' => 
    array (
      'type' => 'time',
      'editable' => false,
    ),
    'store' => 
    array (
      'type' => 'number',
      'editable' => false,
    ),
    'in_num' => 
    array (
      'type' => 'number',
      'editable' => false,
    ),
    'out_num' => 
    array (
      'type' => 'number',
      'editable' => false,
      'default' => 0,
    ),
  ),
  'comment' => '货品价格历史记录',
  'engine' => 'innodb',
  'version' => '$Rev: 44513 $',
);
