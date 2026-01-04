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

$db['order_delivery']=array (
      'columns' =>
        array(
            'id' => array(
                'type' => 'int(10)',
                'pkey' => true,
                'extra' => 'auto_increment',
                'required' => true,
                'label' => '编号',
                'filterdefault' => true,
                'in_list' => true,
                'default_in_list' => false,
                'width' => 60,
                'hidden' => true,
                'order'=>10,
            ),
            'order_bn' =>
            array (
              'type' => 'varchar(32)',
              'required' => true,
              'label' => '订单号',
            ),
            'bn' =>
            array (
              'type' => 'text',
              'label' => '商品编号',
            ),
            'oid' => 
            array (
              'type' => 'text',
              'label' => '子订单号',
            ),
            'quantity' =>
            array (
              'type' => 'varchar(255)',
              'label' => '购买数量',
            ),
            'dateline' => 
            array (
              'type' => 'time',
              'required' => true,
              'default' => '0',
              'label' => '生成日期',
            ),
    ),
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
    'comment' => '订单拆单店铺原子订单记录表',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);