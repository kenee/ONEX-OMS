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

/**
 * 人工库存预占表
 * by wangjianjun 20180227
 */

$db['product_stock_artificial_freeze']=array (
  'columns' =>
  array (
    'psaf_id' => array(
        'type'     => 'int unsigned',
        'required' => true,
        'pkey'     => true,
        'extra'    => 'auto_increment',
        'editable' => false,
    ),
    'branch_id' => array(
        'type' => 'number',
        'comment' => '仓库ID',
        'label' => '仓库ID',
        'editable' => false,
    ),
    'product_id' =>
    array (
        'type' => 'int unsigned',
        'comment' => '货品ID',
        'label' => '货品ID',
        'editable' => false,
    ),
    'freeze_num' => array(
        'type' => 'number',
        'comment' => '预占数量',
        'label' => '预占数量',
        'default' => 0,
        'editable' => false,
        'in_list' => true,
        'default_in_list' => true,
        'width' => 100,
        'order' => 90,
    ),
    'freeze_reason' => array (
        'type' => 'longtext',
        'editable' => false,
        'label' => '预占原因',
        'in_list' => true,
    ),
    'freeze_time' => array(
        'type' => 'time',
        'label' => '预占时间',
        'width' => 130,
        'in_list' => true,
        'default_in_list' => true,
        'order' => 92,
    ),
    'op_id' => array (
        'type' => 'table:account@pam',
        'label' => '操作员',
        'editable' => false,
        'required' => true,
        'in_list' => true,
    ),
    'status' => array(
        'type' => array(
            '1'=>'预占中',
            '2'=>'已释放',
        ),
        'default' => '1',
        'comment' => '状态',
        'label' => '状态',
        'in_list' => false,
        'default_in_list' => false,
        'width' => 80,
        'order' => 95,
    ),
    'update_modified' => array (
        'label' => '更新时间',
        'type' => 'time',
        'width' => 130,
        'in_list' => true,
        'default_in_list' => true,
        'width' => 130,
        'order' => 99,
    ),
    'group_id' => array (
        'label' => '组数据',
        'type' => 'table:product_stock_artificial_freeze_group@ome',
        'width' => 150,
        'in_list' => true,
        'default_in_list' => true,
        'order' => 100,
    ),
    'original_bn' => array (
        'type'     => 'varchar(50)',
        'label'    => '原始单据',
        'editable' => false,
    ),
    'original_type' => array (
        'type'     => 'varchar(20)',
        'label'    => '原始单据类型',
        'editable' => false,
    ),
  ),
    'index' => array (
        'ind_status' =>
        array (
        'columns' =>
            array (
                0 => 'status',
            ),
        ),
        'ind_original' => array ('columns' => array ('original_bn', 'original_type')),
    ),
  'comment' => '人工库存预占表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);
