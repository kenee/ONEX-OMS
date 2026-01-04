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

$db['appropriation_items']=array (
  'columns' => 
  array (
    'item_id' => 
    array (
      'type' => 'number',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
    ),
    'appropriation_id' => 
    array (
      'type' => 'table:appropriation',
      'required' => true,
      'editable' => false,
    ),
    'product_id' =>
    array (
      'type' => 'table:products@ome',
      'required' => true,
      'editable' => false,
    ),
    'bn' => 
    array (
      'type' => 'varchar(30)',
      'editable' => false,
    ),
    'product_name' => 
    array (
      'type' => 'varchar(200)',
      'editable' => false,
    ),
    'from_branch_id' => 
    array (
      'type' => 'table:branch@ome',
      'editable' => false,
    ),
    'from_pos_id' => 
    array (
      'type' => 'table:branch_pos@ome',
      'editable' => false,
    ),
    'to_branch_id' => 
    array (
      'type' => 'table:branch@ome',
      'editable' => false,
      'required' => true,
    ),
    'to_pos_id' => 
    array (
      'type' => 'table:branch_pos@ome',
      'editable' => false,
      'required' => true,
    ),
    'num' => 
    array (
      'type' => 'number',
      'editable' => false,
    ),
    'from_branch_num' => 
    array (
      'type' => 'number',
      'editable' => false,
      'label' => '调出库库存',
      'required' => true,
      'default'=>0,
    ),
    'to_branch_num' => 
    array (
      'type' => 'number',
      'editable' => false,
      'label' => '调入库库存',
      'required' => true,
      'default'=>0,
    ),

  'package_code'   => array(
        'type'            => 'varchar(200)',
        'editable'        => false,
        'in_list'         => true,
        'default_in_list' => true,
        'label'           => '箱单号',
    ),
  ), 
  'comment' => '库存调拨单明细',
  'engine' => 'innodb',
  'version' => '$Rev: 44513 $',
);
