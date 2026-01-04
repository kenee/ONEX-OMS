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

$db['cpfr_items'] = array(
    'columns' => array(
        'item_id'      => array(
            'type'     => 'number',
            'required' => true,
            'pkey'     => true,
            'extra'    => 'auto_increment',
            'editable' => false,
        ),
        'cpfr_id'      => array(
            'type'     => 'table:cpfr',
            'editable' => false,
            'required' => true,
        ),
        'store_bn'     => array(
            'type'     => 'varchar(20)',
            'label'    => '门店编码',
            'editable' => false,
        ),
        'to_branch_id' => array(
            'type' => 'number',
            'label' => '调入仓库',
            'filtertype' => 'normal',
            'filterdefault' => true,
            'default_in_list' => true,
            'in_list' => true,
        ),
        'bn' => array(
            'type'       => 'varchar(30)',
            'label'      => '货号',
            'width'      => 110,
            'editable'   => false,
            'filtertype' => 'normal',
            'in_list'    => true,
        ),
        'product_id' => array (
            'type' => 'int unsigned',
            'required' => true,
            'editable' => false,
            'default_in_list' => true,
            'in_list' => true,
        ),
        'num' => array(
            'type'     => 'number',
            'required' => true,
            'editable' => false,
            'label' => '实际补货数量',
            'default'  => '0',
            'default_in_list' => true,
            'in_list' => true,
            'order' => 50,
        ),
        'original_num' => array(
            'type'     => 'number',
            'required' => true,
            'editable' => false,
            'label' => '申请补货数量',
            'default'  => '0',
            'default_in_list' => true,
            'in_list' => true,
            'order' => 50,
        ),
        'reple_nums' => array(
            'type' => 'number',
            'editable' => false,
            'default'  => 0,
            'label' => '建议补货数量',
            'default_in_list' => true,
            'in_list' => true,
            'order' => 50,
        ),
        'from_branch_store' => array(
            'type' => 'number',
            'editable' => false,
            'default'  => 0,
            'label' => '调出仓库存',
            'default_in_list' => true,
            'in_list' => true,
            'order' => 60,
        ),
        'to_branch_store' => array(
            'type' => 'number',
            'editable' => false,
            'default'  => 0,
            'label' => '调入仓库存',
            'default_in_list' => true,
            'in_list' => true,
            'order' => 62,
        ),
    ),
    'index'   => array(
        'idx_to_branch_id' => array('columns' => array('to_branch_id')),
        'idx_cpfr_store_bn' => array(
            'columns' => array(
                0 => 'cpfr_id',
                1 => 'store_bn',
            ),
        ),
    ),
    'comment' => '配货单明细表',
    'engine'  => 'innodb',
    'version' => '$Rev: 51996',
);
