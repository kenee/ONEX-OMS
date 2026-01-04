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

$db['sales_items'] = [
    'columns' => [
        'id' => [
            'type' => 'int unsigned',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
        ],
        'sale_id' => [
            'type' => 'int unsigned',
            'required' => true,
            'label' => 'VOP销售单ID',
        ],
        'material_bn' => [
            'type' => 'varchar(200)',
            'required' => true,
            'label' => '基础物料编码',
            'width' => 100,
            'in_list' => true,
        ],
        'barcode' => [
            'type' => 'varchar(200)',
            'label' => '基础物料条码',
            'width' => 100,
            'in_list' => true,
        ],
        'material_name' => [
            'type' => 'varchar(200)',
            'label' => '基础物料名称',
            'width' => 100,
            'in_list' => true,
        ],
        'bm_id' => [
            'type' => 'int unsigned',
            'label' => '基础物料ID',
            'width' => 100,
        ],
        'nums' =>[
            'type' => 'number',
            'label' => '发货数量',
            'default' => 0,
            'in_list' => true,
        ],
        'price'             => array(
            'type'    => 'money',
            'default' => 0,
            'label'   => '销售单价',
            'in_list' => true,
        ),
        'amount'             => array(
            'type'    => 'money',
            'default' => 0,
            'label'   => '销售小计',
            'in_list' => true,
        ),
        'settlement_amount' => array(
            'type'    => 'money',
            'default' => '0',
            'label'   => '结算小计',
            'in_list' => true,
        ),
        'at_time'           => [
            'type'    => 'TIMESTAMP',
            'label'   => '创建时间',
            'default' => 'CURRENT_TIMESTAMP',
            'width'   => 120,
            // 'in_list' => true,
        ],
        'up_time'           => [
            'type'    => 'TIMESTAMP',
            'label'   => '更新时间',
            'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'width'   => 120,
            // 'in_list' => true,
        ],
    ],
    'index' => [
        'ind_at_time' => ['columns' => ['at_time']],
        'ind_up_time' => ['columns' => ['up_time']],
    ],
    'comment' => '唯品会销售单明细',
    'engine' => 'innodb',
    'version' => '$Rev: $',
];
