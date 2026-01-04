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

$db['dailystock'] = [
    'columns' => [
        'id'             => [
            'type'     => 'bigint unsigned',
            'required' => true,
            'pkey'     => true,
            'extra'    => 'auto_increment',
            'editable' => false,
        ],
        'stock_date'     => [
            'type'            => 'varchar(15)',
            'required'        => true,
            'label'           => '记录日期',
            'default_in_list' => true,
            'in_list'         => true,
            'order'           => 1,
            'filtertype' => 'normal',
            'filterdefault' => true,
        ],
        'branch_id'      => [
            'type'     => 'int unsigned',
            'label'    => '仓库ID',
            'required' => true,
            'editable' => false,
        ],
        'product_id'     => [
            'type'     => 'int unsigned',
            'label'    => '商品ID',
            'required' => true,
            'editable' => false,
        ],
        'product_bn'     => [
            'type'            => 'varchar(200)',
            'label'           => '基础物料编码',
            'width'           => 150,
            // 'searchtype'      => 'has',
            'filtertype'      => 'textarea',
            'filterdefault'   => true,
            'editable'        => false,
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 10,
            'searchtype'      => 'nequal',
        ],
        'branch_bn'      => [
            'type'            => 'varchar(30)',
            'label'           => '仓库编码',
            'width'           => 85,
            // 'searchtype'      => 'has',
            // 'filtertype'      => 'normal',
            // 'filterdefault'   => true,
            'editable'        => false,
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 20,
            'searchtype'      => 'nequal',
        ],
        'storage_code'         => [
            'type'            => 'varchar(32)',
            'in_list'         => true,
            'default_in_list' => true,
            'label'           => '仓内库位',
        ],
        'stock_num'      => [
            'type'            => 'int',
            'label'           => '期末库存',
            'default'         => 0,
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 30,
        ],
        'in_stock'       => [
            'type'            => 'int',
            'label'           => '入库库存',
            'default'         => 0,
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 40,
        ],
        'out_stock'      => [
            'type'            => 'int',
            'label'           => '出库库存',
            'default'         => 0,
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 50,
        ],
        'sale_stock'     => [
            'type'            => 'int',
            'label'           => '销售库存',
            'default'         => 0,
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 60,
        ],
        'reship_stock'   => [
            'type'            => 'int',
            'label'           => '销退库存',
            'default'         => 0,
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 70,
        ],
        'arrive_stock'   => [
            'type'    => 'int',
            'label'   => '在途库存',
            'default' => 0,
        ],
        'freeze_stock'   => [
            'type'    => 'int',
            'label'   => '冻结库存',
            'default' => 0,
        ],
        'unit_cost'      => [
            'type'    => 'money',
            'label'   => '单位成本',
            'default' => 0,
        ],
        'inventory_cost' => [
            'type'    => 'money',
            'label'   => '库存成本',
            'default' => 0,
        ],
        'in_cost' => [
            'type'    => 'money',
            'label'   => '入库成本',
            'default' => 0,
        ],
        'out_cost' => [
            'type'    => 'money',
            'label'   => '出库成本',
            'default' => 0,
        ],
        'sale_cost' => [
            'type'    => 'money',
            'label'   => '销售成本',
            'default' => 0,
        ],
        'reship_cost' => [
            'type'    => 'money',
            'label'   => '销退成本',
            'default' => 0,
        ],
        'is_change'      => [
            'type'    => 'tinyint(1)',
            'label'   => '较上次是否改变',
            'default' => 0,
        ],
        'at_time'        => [
            'type'    => 'TIMESTAMP',
            'label'   => '创建时间',
            'default' => 'CURRENT_TIMESTAMP',
        ],
        'up_time'        => [
            'type'    => 'TIMESTAMP',
            'label'   => '更新时间',
            'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ],
    ],
    'index'   => [
        'ind_product_id' => ['columns' => ['product_id']],
        'ind_branch_id'  => ['columns' => ['branch_id']],
        'ind_date_bp'    => ['columns' => ['stock_date', 'branch_id', 'product_id'], 'prefix' => 'unique'],
        'ind_at_time'    => ['columns' => ['at_time']],
        'ind_up_time'    => ['columns' => ['up_time']],
        'ind_branch_bn'  => ['columns' => ['branch_bn']],
        'ind_product_bn' => ['columns' => ['product_bn']],
    ],
    'engine'  => 'innodb',
    'version' => '$Rev: 40654 $',
    'comment' => '每日库存快照',
];
