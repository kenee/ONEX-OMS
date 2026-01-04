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

$db['order_objects_extend'] = array(
    'columns' => array(
        'obj_id' => array(
            'type' => 'int unsigned',
            'required' => true,
            'default' => '0',
            'editable' => false,
            'pkey' => true,
            'comment' => '订单obj_id',
        ),
        'order_id' => array(
            'type' => 'int unsigned',
            'required' => true,
            'default' => '0',
            'editable' => false,
            'label' => '订单ID',
        ),
        'store_dly_type' => array(
            'type' => 'tinyint(1)',
            'default' => '0',
            'comment' => '门店发货模式',
            'editable' => false,
        ),
        'store_bn' => array(
            'type' => 'varchar(20)',
            'comment' => '门店编码',
            'editable' => false,
        ),
        'customization' => array(
            'type' => 'longtext',
            'editable' => false,
            'label' => '定制信息',
            'comment' => '商品定制信息,格式:json',
        ),
        'at_time' => array(
            'type' => 'TIMESTAMP',
            'label' => '创建时间',
            'default' => 'CURRENT_TIMESTAMP',
            'width' => 135,
            'filtertype' => 'time',
            'filterdefault' => true,
            'in_list' => true,
            'default_in_list' => true,
        ),
        'up_time' => array(
            'type' => 'TIMESTAMP',
            'label' => '更新时间',
            'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'width' => 135,
            'filtertype' => 'time',
            'filterdefault' => true,
            'in_list' => true,
            'default_in_list' => true,
        ),
        'archive_time' => array(
            'type' => 'int unsigned',
            'label' => '归档时间',
            'width' => 130,
            'editable' => false,
            'in_list' => true,
            'filtertype' => 'time',
            'filterdefault' => true,
        ),
    ),
    'index' => array(
        'ind_at_time' => array(
            'columns' => array(
                0 => 'at_time',
            ),
        ),
        'ind_up_time' => array(
            'columns' => array(
                0 => 'up_time',
            ),
        ),
        'ind_order_id' => array(
            'columns' => array(
                0 => 'order_id',
            ),
        ),
        'ind_archive_time' => array(
            'columns' => array(
                0 => 'archive_time',
            ),
        ),
    ),
    'engine' => 'innodb',
    'version' => '$Rev: 40912 $',
    'comment' => '归档订单Objects扩展表',
); 