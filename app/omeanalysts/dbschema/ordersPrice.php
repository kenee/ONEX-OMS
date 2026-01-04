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

$db['ordersPrice']=array (
    'columns' => array (
        'id' =>
        array (
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'editable' => false,
        ),
        'dates' =>
        array (
          'type' => 'int',
          'label' => '日期',
          'editable' => false,
          'filtertype' => 'time',
          'filterdefault' => true,
          'in_list' => true,
        ),
        'shop_id' =>
        array (
          'type' => 'table:shop@ome',
          'label' => '来源店铺',
          'editable' => false,
          'in_list' => true,
          'filtertype' => 'normal',
          'filterdefault' => true,
        ),
        'interval_id' =>
        array (
            'type' => 'number',
            'label' => '区间ID',
            'in_list' => true,
        ),
        'num' =>
        array (
            'type' => 'int',
            'label' => '数量',
            'in_list' => true,
        ),
      ),
     'index' =>
  array (
    'ind_order_bn_shop' =>
    array (
        'columns' =>
        array (
          0 => 'dates',
          1 => 'interval_id',
        ),
    ),
  ),
    'comment' => '客单价分布',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);