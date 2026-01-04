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

$db['inventory'] = array(
    'columns' => array(
        'inventory_id'   => array(
            'type'     => 'mediumint(8)',
            'required' => true,
            'pkey'     => true,
            'extra'    => 'auto_increment',
            'label'    => '盘点单ID',
        ),
        'inventory_bn'   => array(
            'type'            => 'varchar(32)',
            'required'        => true,
            'width'           => 140,
            'label'           => '盘点单号',
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 40,
            'searchtype'    => 'nequal',
            'filtertype'    => 'normal',
            'filterdefault' => true,
            'panel_id'      => 'inventory_finder_top',
        ),
        'inventory_type' => array(
            'type'            => 'tinyint(1)',
            'default'         => '1',
            'required'        => true,
            'width'           => 90,
            'label'           => '盘点类型',
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 10,
        ),
        'op_id'          => array(
            'type'  => 'varchar(45)',
            'label' => '申请人ID',
        ),
        'createtime'     => array(
            'type'            => 'time',
            'label'           => '创建时间',
            'width'           => '130',
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 25,
        ),
        'physics_id'=>array(
            'type'            => 'table:store@o2o',
            'label'           => '门店名称',
            'in_list'         => true,
            'default_in_list' => true,
        ),
        'branch_id'      => array(
            'type'     => 'mediumint(8)',
            'label'    => '门店仓ID',
            'required' => true,
        ),
        'confirm_op_id'  => array(
            'type'  => 'varchar(45)',
            'label' => '确认人ID',
            'order' => '20',
        ),
        'confirm_time'   => array(
            'type'            => 'time',
            'label'           => '盘点时间',
            'width'           => '130',
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 30,
        ),
        'status'         => array(
            'type'            => 'tinyint(1)',
            'default'         => '1',
            'label'           => '状态',
            'width'           => '70',
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 35,
        ),
    ),
    'index'   => array(
        'ind_inventory_type' => array(
            'columns' => array(
                0 => 'inventory_type',
            ),
        ),
        'ind_status'         => array(
            'columns' => array(
                0 => 'status',
            ),
        ),
        'ind_createtime'     => array(
            'columns' => array('createtime'),
        ),
        'ind_confirm_time'   => array(
            'columns' => array('confirm_time'),
        ),
    ),
    'comment' => '门店盘点主表',
    'engine'  => 'innodb',
    'version' => '$Rev:  $',
);
