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

$db['delivery_items_detail'] = array(
    'columns' =>
        array(
            'item_detail_id' =>
                array(
                    'type' => 'int unsigned',
                    'required' => true,
                    'pkey' => true,
                    'extra' => 'auto_increment',
                    'editable' => false,
                ),
            'delivery_id' =>
                array(
                    'type' => 'table:delivery@ome',
                    'required' => true,
                    'editable' => false,
                ),
            'delivery_item_id' =>
                array(
                    'type' => 'int unsigned',
                    'required' => true,
                    'editable' => false,
                ),
            'order_id' =>
                array(
                    'type' => 'table:orders@ome',
                    'required' => true,
                    'editable' => false,
                ),
            'order_item_id' =>
                array(
                    'type' => 'int unsigned',
                    'required' => true,
                    'editable' => false,
                ),
            'order_obj_id' =>
                array(
                    'type' => 'int unsigned',
                    'required' => true,
                    'editable' => false,
                ),
            'item_type' =>
                array(
                    'type' =>
                        array(
                            'product' => '商品',
                            'gift' => '赠品',
                            'pkg' => '捆绑商品',
                            'adjunct' => '配件',
                        ),
                    'default' => 'product',
                    'required' => true,
                    'editable' => false,
                ),
            'product_id' =>
                array(
                    'type' => 'table:products@ome',
                    'required' => true,
                    'editable' => false,
                ),
            'bn' =>
                array(
                    'type' => 'varchar(30)',
                    'editable' => false,
                    'is_title' => true,
                ),
            'number' =>
                array(
                    'type' => 'number',
                    'required' => true,
                    'editable' => false,
                ),
            'price' =>
                array(
                    'type' => 'money',
                    'default' => '0',
                    'required' => true,
                    'editable' => false,
                    'comment' => '平均单价'
                ),
            'amount' =>
                array(
                    'type' => 'money',
                    'default' => '0',
                    'required' => true,
                    'editable' => false,
                ),
        ),
    'index' =>
        array(
            'ind_delivery_item_id' =>
                array(
                    'columns' =>
                        array(
                            0 => 'delivery_item_id',
                        ),
                ),
            'ind_order_item_id' =>
                array(
                    'columns' =>
                        array(
                            0 => 'order_item_id',
                        ),
                ),
            'ind_order_obj_id' =>
                array(
                    'columns' =>
                        array(
                            0 => 'order_obj_id',
                        ),
                ),
        ),
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);