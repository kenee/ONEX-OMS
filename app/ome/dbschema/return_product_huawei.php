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

$db['return_product_huawei'] = array(
    'columns' => array(
        'shop_id' => array(
            'type' => 'table:shop@ome',
            'label' => '来源店铺',
            'pkey' => true,
            'required' => true,
            'width' => 75,
            'editable' => false,
        ),
        'return_id' => array(
            'type' => 'table:return_product@ome',
            'pkey' => true,
            'required' => true,
            'editable' => false,
            'comment' => '售后ID',
        ),
        'return_bn' => array(
            'type' => 'varchar(32)',
            'required' => true,
            'label' => '退货记录流水号',
            'comment' => '退货记录流水号',
            'editable' => false,
        ),
        'oid' => array(
            'type' => 'varchar(32)',
            'default' => 0,
            'editable' => false,
            'label' => '子订单号',
        ),
        'refund_type' => array(
            'type' => array(
                'refund' => '退款单',
                'return' => '退货单',
                'change' => '换货',
            ),
            'default' => 'return',
        ),
        'bill_type' => array(
            'type' => array(
                'refund_bill' => '退款单',
                'return_bill' => '退货单',
            ),
            'default' => 'return_bill',
        ),
        'refund_fee' => array(
            'type' => 'money',
            'label' => '需退金额',
        ),
        'jsrefund_flag' => array(
            'type' => 'bool',
            'default' => 'false',
            'required' => true,
            'label' => '是否极速退款',
            'editable' => false,
        ),
        'exchange_sku' => array(
            'type' => 'varchar(32)',
            'label' => '换货商品的sku',
            'default' => '',
        ),
        'exchange_num' => array(
            'type' => 'number',
            'label' => '换货商品数量',
            'default' => 0,
        ),
        'exchange_price' => array(
            'type' => 'money',
            'label' => '换货金额',
        ),
        'refuse_memo' => array(
            'type' => 'longtext',
            'label' => '拒绝退款原因留言',
        ),
        'imgext' =>
            array(
                'type' => 'varchar(10)',
                'editable' => false,

            ),
    ),
    'index' => array(
        'ind_return_bn_shop' => array(
            'columns' =>
                array(
                    0 => 'return_id',
                    1 => 'shop_id',
                ),
            'prefix' => 'unique',
        ),
        'ind_oid' => array(
            'columns' => array(
                0 => 'oid',
            ),
        ),
    ),
    'comment' => '抖音售后申请附加信息表',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);
