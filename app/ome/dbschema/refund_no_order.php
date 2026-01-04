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

$db['refund_no_order']=array (
    'columns' =>
        array (
            'id' =>
                array (
                    'type' => 'int unsigned',
                    'required' => true,
                    'pkey' => true,
                    'editable' => false,
                    'extra' => 'auto_increment',
                ),
            'order_bn' =>
                array (
                    'type' => 'varchar(32)',
                    'default' => '',
                    'commit' => '订单号',
                    'editable' => false,
                ),
            'shop_id' =>
                array (
                    'type' => 'table:shop@ome',
                    'default' => '',
                    'commit' => '店铺ID',
                    'editable' => false,
                ),
            'refund_bn' =>
                array (
                    'type' => 'varchar(32)',
                    'default' => '',
                    'commit' => '退款单号',
                    'editable' => false,
                ),
            'status' =>
                array (
                    'type' => 'varchar(64)',
                    'default' => '',
                    'commit' => '退款单状态',
                    'editable' => false,
                ),
            'sdf' =>
                array (
                    'type' => 'text',
                    'default' => '',
                    'commit' => '格式化后数据',
                    'editable' => false,
                ),
        ),
    'comment' => '支付记录',
    'index' =>
        array (
            'ind_order_bn' =>
                array (
                    'columns' =>
                        array (
                            0 => 'order_bn',
                        ),
                ),
        ),
    'engine' => 'innodb',
    'version' => '$Rev: 41103 $',
    'commit' => '退款单无订单表'
);