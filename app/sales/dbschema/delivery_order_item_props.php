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

$db['delivery_order_item_props'] = array(
    'columns' => array(
        'id'   => array(
            'type'     => 'int unsigned',
            'extra'    => 'auto_increment',
            'pkey'     => true,
            'editable' => false,
            'label'    => '自增ID',
        ),
        'item_detail_id'  => array(
            'type'          => 'table:delivery_order_item@sales',
            'label'         => '明细ID',
            'parent_id'     => true,
            'in_list'       => true,
            'default_in_list' => true,
            'order'         => 10,
        ),
        'props_col'  => array(
            'type'          => 'varchar(255)',
            'label'         => '键名',
            'in_list'       => true,
            'default_in_list' => true,
            'order'         => 20,
        ),
        'props_value'  => array(
            'type'          => 'varchar(255)',
            'label'         => '键值',
            'in_list'       => true,
            'default_in_list' => true,
            'order'         => 30,
        ),
        'at_time'       => array(
            'type'            => 'TIMESTAMP',
            'label'           => '创建时间',
            'default'         => 'CURRENT_TIMESTAMP',
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 1000,
        ),
        'up_time'       => array(
            'type'            => 'TIMESTAMP',
            'label'           => '更新时间',
            'default'         => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 1010,
        ),
    ),
    'index'   => array(
        'idx_at_time'       => array('columns' => array('at_time')),
        'idx_up_time'       => array('columns' => array('up_time')),
    ),
    'engine'  => 'innodb',
    'commit'  => '',
    'version' => 'Rev: 41996 $',
);