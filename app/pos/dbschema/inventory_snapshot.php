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

$db['inventory_snapshot'] = [
    'columns' => [
        'id'          => [
            'type'     => 'int unsigned',
            'label'    => 'ID',
            'comment'  => 'ID',
            'required' => true,
            'pkey'     => true,
            'extra'    => 'auto_increment',
        ],
        'stock_date'  => [
            'type'            => 'DATE',
            'required'        => true,
            'label'           => '记录日期',
            'default_in_list' => true,
            'in_list'         => true,
            'order'           => 10,
            'filtertype'    => 'date',
            'filterdefault' => true,
        ],
        'store_id'    => [
            'type'     => 'int unsigned',
            'label'    => '门店ID',
            'required' => true,
        ],
        'store_bn'    => [
            'type'            => 'varchar(20)',
            'label'           => '门店编码',
            'required'        => true,
            'searchtype'      => 'nequal',
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 20,
            'filtertype'    => 'normal',
            'filterdefault' => true,
        ],
        'branch_bn'   => [
            'type'            => 'varchar(32)',
            'label'           => '仓库编号',
            'required'        => true,
            'searchtype'      => 'nequal',
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 30,
            'filtertype'    => 'normal',
            'filterdefault' => true,
        ],
        'branch_id'   => [
            'type'     => 'mediumint unsigned',
            'label'    => '仓库ID',
            'required' => true,
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
        'pos_stock'   => [
            'type'            => 'int',
            'label'           => '门店库存',
            'default'         => 0,
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 70,
        ],
        'total_count' => [
            'type'    => 'mediumint unsigned',
            'label'   => '总行数',
            'default' => 0,
            'in_list' => true,
            // 'default_in_list' => true,
            'order'   => 70,
        ],
        'get_count'   => [
            'type'    => 'mediumint unsigned',
            'default' => 0,
            'label'   => '获取行数',
            'in_list' => true,
            // 'default_in_list' => true,
            'order'   => 80,
        ],
        'status'      => [
            'type'    => [
                '1' => '处理中', '2' => '处理完成', '3' => '处理失败',
            ],
            'label'   => '单据状态',
            'default' => '1',
            'in_list' => true,
            // 'default_in_list' => true,
            'order'   => 90,
        ],
        'errmsg'      => [
            'type'    => 'varchar(255)',
            'label'   => '错误信息',
            'in_list' => true,
            // 'default_in_list' => true,
            'order'   => 90,
        ],
        'at_time'     => [
            'type'    => 'TIMESTAMP',
            'label'   => '创建时间',
            'default' => 'CURRENT_TIMESTAMP',
            'width'   => 120,
            'in_list' => true,
            // 'default_in_list' => true,

        ],
        'up_time'     => [
            'type'    => 'TIMESTAMP',
            'label'   => '更新时间',
            'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'width'   => 120,
            'in_list' => true,
            // 'default_in_list' => true,

        ],
    ],
    'index'   => [
        'ind_store_bn'   => ['columns' => ['store_bn']],
        'ind_stock_date' => ['columns' => ['stock_date', 'store_id', 'branch_id'], 'prefix' => 'unique'],
        'ind_status'     => ['columns' => ['status']],
    ],
    'comment' => 'POS库存快照',
    'engine'  => 'innodb',
    'version' => '$Rev:  $',
];
