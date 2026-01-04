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

#订单预处理表，记录预处理的一些状态 wangkezheng 2014-08-12
$db['order_preprocess']=array (
        'columns' =>
        array (
                'preprocess_order_id' =>
                array (
                        'type' => 'table:orders@ome',
                        'required' => true,
                        'pkey' => true,
                        'editable' => false,
                ),
                'preprocess_type' =>
                array (
                        'type' =>
                        array (
                               'pay' => 'pay',
                               'flag' =>'flag',
                               'logi' =>'logi',
                               'member' => 'member',
                               'ordermulti' => 'ordermulti',
                               'ordersingle' => 'ordersingle',
                               'branch' => 'branch',
                               'store' => 'store',
                               'abnormal' => 'abnormal',
                               'oversold' => 'oversold',
                               'tbgift' => 'tbgift',
                               'shopcombine' => 'shopcombine',
                               'crm' => 'crm',
                               'tax' =>'tax'
                        ),
                        'default' => 'crm',
                        'required' => true,
                        'label' => '预处理类型',
                        'editable' => false,
                ),
                'preprocess_status' =>
                array (
                        'type' =>
                        array (
                                0 => '未完成',
                                1=>'已完成',
                        ),
                        'default' => '0',
                        'required' => true,
                        'label' => '预处理状态',
                ),
        ),
        'comment' => '订单预处理记录表',
        'engine' => 'innodb',
        'version' => '$Rev:  $',
);