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

$db['order_wait_items'] = array(
    'columns' => array(
        'owi_id' =>
            array(
                'type' => 'number',
                'required' => true,
                'pkey' => true,
                'extra' => 'auto_increment',
                'editable' => false,
                'order' => 1,
            ),
        'ow_id' =>
            array(
                'type' => 'table:order_wait@purchase',
                'required' => true,
                'editable' => false,
                'order' => 2,
            ),
        'product_id' =>
            array(
                'type' => 'table:products@ome',
                'default' => 0,
                'label' => '货品ID',
                'order' => 3,
            ),
        'bn' =>
            array(
                'type' => 'varchar(32)',
                'default' => '',
                'label' => '货号',
                'order' => 3,
            ),
        'barcode' =>
            array(
                'type' => 'varchar(32)',
                'default' => '',
                'label' => '条形码',
                'order' => 3,
            ),
        'product_name' =>
            array(
                'type' => 'varchar(32)',
                'default' => '',
                'label' => '货品名',
                'order' => 3,
            ),
        'brand_name' =>
            array(
                'type' => 'varchar(32)',
                'default' => '',
                'label' => '品牌',
                'order' => 3,
            ),
        'size' =>
            array(
                'type' => 'varchar(32)',
                'default' => '',
                'label' => '尺寸',
                'order' => 3,
            ),
        'quantity' =>
            array(
                'type' => 'varchar(32)',
                'default' => '',
                'label' => '数量',
                'order' => 3,
            ),
        'po_no' =>
            array(
                'type' => 'varchar(32)',
                'default' => '',
                'label' => '采购订单号',
                'order' => 3,
            ),
        'cooperation_no' =>
            array(
                'type' => 'varchar(32)',
                'default' => '',
                'label' => '常态合作编码',
                'order' => 3,
            ),
    ),
    'comment' => '待寻仓订单明细',
    'engine' => 'innodb',
    'version' => '$Rev: $',
);