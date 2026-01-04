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

# ALTER TABLE `sdb_siso_iostock_type` DROP PRIMARY KEY; 
# ALTER TABLE `sdb_siso_iostock_type` ADD COLUMN `id` mediumint(8) unsigned not null auto_increment PRIMARY KEY FIRST
$db['iostock_type']=array (
  'columns' =>
  array (
    'id' =>
    array (
      'type' => 'number',
      'extra' => 'auto_increment',
      'required' => true,
      'pkey' => true,
    ),
    'type_id' =>
    array (
      'type' => 'number',
      'label' => '类型ID',
    ),
    'type_name' =>
    array (
      'type' => 'varchar(32)',
      'label' => '类型名称',
      'is_title' => true,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'bill_type' =>
    array (
      'type' => 'varchar(255)',
      'label' => '业务类型编码',
      'in_list' => true,
      'default_in_list' => true,
    ),
    'bill_type_name' =>
    array (
      'type' => 'varchar(255)',
      'label' => '业务类型名称',
      'in_list' => true,
      'default_in_list' => true,
    ),
    'at_time'       => array(
        'type'            => 'TIMESTAMP',
        'label'           => '创建时间',
        'default_in_list' => true,
        'in_list'         => true,
        'filtertype'      => 'time',
        'filterdefault'   => true,
        'default'         => 'CURRENT_TIMESTAMP',
        'order' => 100,
    ),
    'up_time'       => array(
        'type'            => 'TIMESTAMP',
        'label'           => '更新时间',
        'default_in_list' => true,
        'in_list'         => true,
        'filtertype'      => 'time',
        'filterdefault'   => true,
        'default'         => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        'order' => 110,
    ),
  ),
  'index' =>
  array (
    'idx_type_bill_type' => ['columns'=>['type_id','bill_type'], 'prefix' => 'UNIQUE']
  ),
  'comment' => '出入库类型',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);