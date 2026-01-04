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

$db['inventory_apply_items']=array (
  'columns' =>
  array (
    'item_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
    ),
    'inventory_apply_id' =>
    array (
      'type' => 'table:inventory_apply@console',
      'required' => true,
    ),
    'bm_id' =>
    array (
      'type' => 'table:products@ome',
      'required' => true,
    ),
    'material_bn' =>
    array (
      'type' => 'varchar(50)',
      'label' => '基础物流编码',
      'in_list' => true,
      'default_in_list' => true,
    ),
    'wms_stores' =>
    array (
      'type' => 'mediumint',
      'default' => 0,
      'label' => 'wms库存',
      'in_list' => true,
      'default_in_list' => true,
    ),
    'oms_stores' =>
    array (
      'type' => 'mediumint',
      'default' => 0,
      'label' => 'oms库存',
      'in_list' => true,
      'default_in_list' => true,
    ),
    'diff_stores' =>
    array (
      'type' => 'mediumint',
      'default' => 0,
      'label' => '差异数量',
      'in_list' => true,
      'default_in_list' => true,
    ),
    'm_type' =>
    array (
      'type' => [
        'zp' => '良品',
        'cc' => '残品',
      ],
      'default' => 'zp',
      'label' => '良/残品',
      'in_list' => true,
      'default_in_list' => true,
    ),
    'is_confirm' =>
    array (
      'type' => [
        '0' => '未确认',
        '1' => '已确认',
      ],
      'default' => '0',
      'label' => '状态',
      'in_list' => true,
      'default_in_list' => true,
    ),
    'memo' =>
    array (
      'type' => 'text',
      'label' => '备注',
      'in_list' => true,
    ),
  'batch'      => array(
    'type'            => 'text',
    'label'           => 'batch',
    'default_in_list' => true,
    'in_list'         => true,
    'order' => 20,
  ),
  ),
  'comment' => '盘点申请明细表',
  'engine' => 'innodb',
  'version' => '$Rev: 44513 $',
);