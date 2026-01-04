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

$db['cos'] = [
    'columns' => [
        'cos_id'      => [
            'type'     => 'int unsigned',
            'required' => true,
            'pkey'     => true,
            'extra'    => 'auto_increment',
            'label'    => '企业组织架构ID',
        ],
        'cos_code'    => array(
            'type'            => 'varchar(32)',
            'required'        => true,
            'label'           => '企业组织编码',
            'in_list'         => true,
            'default_in_list' => true,
            'searchtype'      => 'nequal',
            'filtertype'      => 'normal',
            'filterdefault'   => true,
        ),
        'cos_name'    => array(
            'type'            => 'varchar(50)',
            'label'           => '企业组织名称',
            'editable'        => false,
            'is_title'        => true,
            'in_list'         => true,
            'default_in_list' => true,
        ),
        'cos_type'    => [
            'type'            => [
                'bbu'  => '销售团队',
                'betc' => '贸易公司',
                'bs'   => '经销商',
                'shop' => '经销店铺',
            ],
            'label'           => '企业组织类型',
            'editable'        => false,
            'is_title'        => true,
            'in_list'         => true,
            'default_in_list' => true,
        ],
        'parent_id'   => [
            'type'     => 'int unsigned',
            'editable' => false,
            'required' => true,
            'label'    => '父ID',
        ],
        'cos_path'    => [
            'type'            => 'varchar(255)',
            'label'           => '路径',
            'editable'        => false,
            'width'           => 110,
            'in_list'         => true,
            'default_in_list' => true,
        ],
        'is_leaf'     => [
            'type'            => "enum('1', '0')",
            'editable'        => false,
            'default'         => '1',
            'label'           => '是否叶子节点',
            'width'           => 110,
            'in_list'         => true,
            'default_in_list' => true,
        ],
        'child_count' => [
            'type'            => 'int unsigned',
            'editable'        => false,
            'label'           => '子节点数',
            'width'           => 100,
            'in_list'         => true,
            'default_in_list' => true,
        ],
        'op_name'     => [
            'type'            => 'varchar(25)',
            'editable'        => false,
            'label'           => '操作人',
            'width'           => 140,
            'in_list'         => true,
            'default_in_list' => true,
        ],
        'out_bind_id' => [
            'type'            => 'text',
            'editable'        => false,
            'label'           => '绑定集团外部公司组织ID',
            'width'           => 140,
            'in_list'         => true,
            'default_in_list' => true,
        ],
        'at_time'     => [
            'type'    => 'TIMESTAMP',
            'label'   => '创建时间',
            'default' => 'CURRENT_TIMESTAMP',
            'width'   => 120,
            'in_list' => false,
        ],
        'up_time'     => [
            'type'    => 'TIMESTAMP',
            'label'   => '更新时间',
            'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'width'   => 120,
            'in_list' => false,
        ],
    ],
    'index'   => [
        'ind_cos_code'  => [
            'columns' => [
                0 => 'cos_code',
            ],
            'prefix'  => 'unique',
        ],
        'ind_cos_type'  => [
            'columns' => [
                0 => 'cos_type',
            ],
        ],
        'ind_parent_id' => [
            'columns' => [
                0 => 'parent_id',
            ],
        ],
    ],
    'comment' => '企业组织架构表',
    'engine'  => 'innodb',
    'version' => '$Rev:  $',
];
