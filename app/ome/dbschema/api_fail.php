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

$db['api_fail']=array (
  'columns' => 
  array (
    'order_id' => 
    array (
      'type' => 'table:orders@ome',
      'required' => true,
      'default' => 0,
      'editable' => false,
      'label' => '订单ID',
    ),
    'type' =>
    array (
      'type' => 
      array (
        'payment' => '支付',
        'refund' => '退款',
      ),
      'required' => true,
      'default' => 'payment',
      'label' => '请求类型'
    ),
  ),
  'index' =>
  array (
    'ind_orderid_type' =>
    array (
        'columns' =>
        array (
          0 => 'order_id',
          1 => 'type'
        ),
        'prefix' => 'unique',
    ),
  ),
  'comment' => '请求失败记录',
  'engine' => 'innodb',
  'version' => '$Rev: 44513 $',
);
