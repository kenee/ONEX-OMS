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

$db['dailyinventory_items'] = [
    'columns' => [
        'id'             => [
            'type'     => 'int unsigned',
            'label'    => 'ID',
            'comment'  => 'ID',
            'required' => true,
            'pkey'     => true,
            'extra'    => 'auto_increment',
        ],
        'stock_date'        => [
            'type'            => 'DATE',
            'label'           => '日期',
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 5,
        ],
        'dlyinv_id'      => [
            'type'     => 'int unsigned',
            'required' => true,
            // 'in_list'         => true,
            // 'default_in_list' => true,
            // 'order'    => 10,
        ],
        'warehouse_code' => [
            'type'            => 'varchar(32)',
            'label'           => '仓编码',
            'in_list'         => true,
            'default_in_list' => false,
            'order'           => 10,
        ],
        'material_bn'    => [
            'type'            => 'varchar(200)',
            'label'           => '物料编码',
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 20,
            'searchtype'      => 'nequal',
            'filtertype'      => 'normal',
            'filterdefault'   => true,
        ],
        'storage_code'         => array(
            'type'            => 'varchar(32)',
            'in_list'         => true,
            'default_in_list' => true,
            'label'           => '库位',
            'searchtype'      => 'nequal',
            'filtertype'      => 'normal',
            'filterdefault'   => true,
        ),
        'bm_id'          => [
            'type'            => 'int unsigned',
            'label'           => '物料ID',
            // 'in_list'         => true,
            // 'default_in_list' => true,
            'order'           => 30,
        ],
        'material_name'  => [
            'type'            => 'varchar(200)',
            'label'           => '物料名称',
            // 'in_list'         => true,
            // 'default_in_list' => true,
            // 'order'           => 30,
        ],
        'oms_stock'      => [
            'type'            => 'int',
            'label'           => '系统库存',
            'default'         => 0,
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 60,
        ],
        'outer_stock'    => [
            'type'            => 'int',
            'label'           => '外部库存',
            'default'         => 0,
            // 'in_list'         => true,
            // 'default_in_list' => true,
            // 'order'           => 70,
        ],
        'diff_stock'     => [
            'type'            => 'int',
            'label'           => '库存差异',
            'default'         => 0,
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 80,
            'filtertype'      => 'number',
            'filterdefault'   => true,
        ],
        'invs_id'      => array(
            'type'    => 'int unsigned',
            'label' => '快照ID',
        ),
        'at_time'        => [
            'type'    => 'TIMESTAMP',
            'label'   => '创建时间',
            'default' => 'CURRENT_TIMESTAMP',
            'width'   => 120,
            'in_list' => false,
            'order'   => 11,
        ],
        'up_time'        => [
            'type'    => 'TIMESTAMP',
            'label'   => '更新时间',
            'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'width'   => 120,
            'in_list' => false,
            'order'   => 11,
        ],
        'diff_type'       => [
            'type'            => 'tinyint(1)',
            'label'           => '对比方式',
            'default' => '1',
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 70,
            'filtertype'    => 'number',
            'filterdefault' => true,
        ],
    ],
    'index'   => [
        'ind_warehouse_code' => ['columns' => ['warehouse_code']],
        'ind_dlyinv_id'      => ['columns' => ['dlyinv_id', 'warehouse_code', 'material_bn'], 'prefix' => 'unique'],
        'ind_bm_id'          => ['columns' => ['bm_id']],
    ],
    'comment' => '日盘单wms仓库',
    'engine'  => 'innodb',
    'version' => '$Rev:  $',
];
