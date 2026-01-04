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

$db['platform_order_extend'] = array(
    'columns' => array(
        'plat_order_id' => array(
            'pkey' => 'true',
            'type' => 'int unsigned',
            'label' => '订单ID',
            'required' => true,
        ),
        'plat_order_bn' => array(
            'type' => 'varchar(32)',
            'label' => '订单号',
            'editable' => true,
            'in_list' => true,
            'default_in_list' => true,
        ),
        'extend_info' => array(
            'type' => 'longtext',
            'label' => '平台订单原始信息',
            'editable' => false,
            'in_list' => false,
            'default_in_list' => false,
        ),
        'create_time' => array(
            'type' => 'time',
            'label' => '创建时间',
            'editable' => false,
            'in_list' => true,
            'default_in_list' => false,
        ),
        'last_modified' => array(
            'type' => 'time',
            'label' => '最后修改时间',
            'editable' => false,
            'in_list' => true,
            'default_in_list' => false,
        ),
    ),
    'index' => array(
        'uni_plat_order_id' => array(
            'columns' => array(
                0 => 'plat_order_id',
            ),
            'prefix' => 'unique',
        ),
        'uni_plat_order_bn' => array(
            'columns' => array(
                0 => 'plat_order_bn',
            ),
            'prefix' => 'unique',
        ),
        'ind_create_time' => array(
            'columns' => array(
                0 => 'create_time',
            ),
        ),
    ),
    'engine' => 'innodb',
    'version' => '$Rev: $',
    'comment' => '平台订单信息表',
);