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

$db['supplier_relation']=array (
  'columns' =>
  array (
    'wms_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'editable' => false,
    ),
    'supplier_id' =>
    array (
      'type' => 'number',
      'required' => true,
      'pkey' => true,
      'editable' => false,
      'comment' => '供应商ID',
    ),
    'wms_supplier_bn' =>
    array (
      'type' => 'varchar(32)',
      'editable' => false,
      'comment' => 'WMS供应商编号',
    ),
  ),
  'engine' => 'innodb',
  'version' => '$Rev: 41996 $',
);