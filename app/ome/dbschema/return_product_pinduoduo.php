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

$db['return_product_pinduoduo']=array(
    'columns' =>
        array(
            'shop_id' => array(
                'type' => 'table:shop@ome',
                'label' => '来源店铺',
                'pkey' =>true,
                'required' =>true,
                'width' => 75,
                'editable' =>false,
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
            'shipping_type' => array(
                'type'=>'varchar(45)',
                'label'=>'物流方式',
            ),
            'cs_status' => array(
                'type' => 'varchar(50)',
                'default'=>'1',
                'comment' => '客服介入状态',
                'editable' => false,
                'Label' => '客服介入状态',
                'width' =>65,
            ),
            'operation_constraint' => array(
                'type' => array(
                    'cannot_refuse'=> '不允许操作',
                    'refund_onweb' => '需要到网页版操作',
                ),
                'default'=>'cannot_refuse',
                'editable' =>false,
                'label' => '退款约束',
            ),
            'payment_id' => array(
                'type'=>'varchar(100)',
                'Label'=>'支付交易号',
            ),
            'buyer_nick' => array(
                'type'=>'varchar(50)',
                'label'=>'买家昵称',
            ),
            'seller_nick' => array(
                'type'=>'varchar(50)',
                'label'=>'卖家昵称',
            ),
            'has_good_return' => array(
                'type' => 'varchar(32)',
                'Label'=>'买家是否需要退货',
            ),
            'good_return_time' => array(
                'type' => 'time',
                'label' => '退货时间',
            ),
            'oid' => array(
                'type' => 'varchar(50)',
                'default' => 0,
                'editable' => false,
                'label' => '子订单号',
            ),
            'refund_fee'=>array(
                'type'=>'money',
                'label'=>'需退金额',
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

        ),
    'index' =>
        array(
            'ind_return_apply_bn_shop' =>
                array(
                    'columns' =>
                        array(
                            0 => 'return_id',
                            1 => 'shop_id',
                        ),
                    'prefix' => 'unique',
                ),

        ),
    'comment' => '售后申请拼多多附加信息表',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);
