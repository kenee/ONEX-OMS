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

/**
 * 订单异常数据表
 *
 * @author wangbiao@shopex.cn
 * @version 2024.12.26
 */

$db['order_abnormal'] = array (
    'columns' => array(
        'aid' => array(
            'type' => 'int unsigned',
            'required' => true,
            'pkey' => true,
            'editable' => false,
            'extra' => 'auto_increment',
            'order' => 1,
        ),
        'order_id' => array(
            'type' => 'table:orders@ome',
            'required' => true,
            'default' => 0,
            'editable' => false,
            'label' => '订单ID',
            'width' => 120,
            'in_list' => true,
            'default_in_list' => true,
            'order' => 10,
        ),
        'abnormal_type' => array (
            'type' => 'varchar(30)',
            'editable' => false,
            'label' => '异常类型',
            'width' => 130,
            'in_list' => true,
            'default_in_list' => true,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'order' => 20,
        ),
        'abnormal_msg' => array (
            'type' => 'text',
            'editable' => false,
            'label' => '异常信息',
            'order' => 90,
        ),
        'at_time' => array(
            'type' => 'TIMESTAMP',
            'label' > '创建时间',
            'default' => 'CURRENT_TIMESTAMP',
            'width' => 120,
        ),
        'up_time' => array(
            'type' => 'TIMESTAMP',
            'label' => '更新时间',
            'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'width' => 120,
        ),
    ),
    'index' => array(
        'ind_abnormal_type' => array(
            'columns' => array(
                0 => 'abnormal_type',
            ),
        ),
        'ind_order_abnormal' => array(
            'columns' => array(
                0 => 'order_id',
                1 => 'abnormal_type',
            ),
        ),
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
    ),
    'comment' => '订单异常表',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);