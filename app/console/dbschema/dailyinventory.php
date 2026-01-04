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

$db['dailyinventory'] = [
    'columns' => [
        'id'                => [
            'type'     => 'int unsigned',
            'label'    => 'ID',
            'comment'  => 'ID',
            'required' => true,
            'pkey'     => true,
            'extra'    => 'auto_increment',
        ],
        'dailyinventory_bn' => [
            'type'            => 'varchar(32)',
            'label'           => '日盘单号',
            'required'        => true,
            'in_list'         => true,
            'default_in_list' => true,
            'searchtype'      => 'nequal',
            'filtertype'      => 'normal',
            'filterdefault'   => true,
            'order'           => 10,
            'width'   => 180,
        ],
        'channel_id'        => [
            'type'          => 'int unsigned',
            'required'      => true,
            // 'in_list'         => true,
            // 'default_in_list' => true,
            // 'filtertype'    => 'normal',
            // 'filterdefault' => true,
            // 'order'         => 20,
        ],
        'channel_bn'        => [
            'type'          => 'varchar(100)',
            'required'      => true,
            // 'in_list'         => true,
            // 'default_in_list' => true,
            // 'filtertype'    => 'normal',
            // 'filterdefault' => true,
            // 'order'         => 20,
        ],
        'channel_type'      => [
            'type'            => [
                'wms'   => '仓库',
                'store' => '门店',
            ],
            'default'         => 'wms',
            'label'           => '类型',
            // 'order'           => 100,
        ],
        'stock_date'        => [
            'type'            => 'DATE',
            'label'           => '日期',
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 30,
            'width' => '140',
            'filtertype'      => 'normal',
            'filterdefault'   => true,
        ],
        'oms_stock'         => [
            'type'            => 'int',
            'label'           => '系统库存',
            'default'         => 0,
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 40,
        ],
        'outer_stock'    => [
            'type'            => 'int',
            'label'           => '外部库存',
            'default'         => 0,
            // 'in_list'         => true,
            // 'default_in_list' => true,
            // 'order'           => 70,
        ],
        'diff_stock'        => [
            'type'            => 'int',
            'label'           => '库存差异',
            'default'         => 0,
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 60,
            'filtertype'      => 'number',
            'filterdefault'   => true,
        ],
        'is_diff'           => [
            'type'            => 'intbool',
            'default'         => '0',
            'label'           => '存在差异',
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 70,
            'filtertype'      => 'normal',
            'filterdefault'   => true,
        ],
        'at_time'           => [
            'type'    => 'TIMESTAMP',
            'label'   => '创建时间',
            'default' => 'CURRENT_TIMESTAMP',
            'width'   => 120,
            'in_list' => false,
            // 'order'   => 11,
        ],
        'up_time'           => [
            'type'    => 'TIMESTAMP',
            'label'   => '更新时间',
            'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'width'   => 120,
            'in_list' => false,
            // 'order'   => 11,
        ],
    ],
    'index'   => [
        'ind_dlyinv_bn' => ['columns' => ['dailyinventory_bn'], 'prefix' => 'unique'],
        'ind_uni'       => ['columns' => ['stock_date', 'channel_id', 'channel_type'], 'prefix' => 'unique'],
    ],
    'comment' => '日盘单',
    'engine'  => 'innodb',
    'version' => '$Rev:  $',
];
