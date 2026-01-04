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

$db['order_pmt'] = array(
    'columns' => array(
        'id' => array(
            'type' => 'int unsigned',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'editable' => false,
        ),
        'order_id' => array(
            'type' => 'int unsigned',
            'required' => true,
            'editable' => false,
            'label' => '订单ID',
        ),
        'pmt_amount' => array(
            'type' => 'money',
            'editable' => false,
            'label' => '促销金额',
        ),
        'pmt_memo' => array(
            'type' => 'longtext',
            'editable' => false,
            'label' => '促销备注',
        ),
        'pmt_describe' => array(
            'type' => 'longtext',
            'editable' => false,
            'label' => '促销描述',
        ),
        'coupon_id' => array(
            'type' => 'varchar(32)',
            'label' => '优惠券ID',
            'in_list' => false,
            'default_in_list' => false,
        ),
        'up_time' => array(
            'type' => 'TIMESTAMP',
            'label' => '更新时间',
            'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'width' => 130,
            'in_list' => true,
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
    'comment' => '归档订单促销规则',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
); 