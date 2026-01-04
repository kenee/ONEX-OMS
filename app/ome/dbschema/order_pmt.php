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

$db['order_pmt']=array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
    ),
    'order_id' =>
    array (
      'type' => 'table:orders@ome',
      'required' => true,
      'editable' => false,
    ),
    'pmt_amount' =>
    array (
      'type' => 'money',
      'editable' => false,
    ),
    'pmt_memo' =>
    array (
      'type' => 'longtext',
      'edtiable' => false,
    ),
    'pmt_describe' =>
    array (
      'type' => 'longtext',
      'editable' => false,
    ),
    'coupon_id' => array(
        'type' => 'varchar(32)',
        'label' => '优惠券ID',
        'in_list' => false,
        'default_in_list' => false,
    ),
    'up_time'           => [
        'type'    => 'TIMESTAMP',
        'label'   => '更新时间',
        'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        'width'           => 130,
        'in_list' => true,
    ],
  ), 
  'index' => [
        'ind_up_time' => ['columns' => ['up_time']],
  ],
  'comment' => '订单促销规则',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);