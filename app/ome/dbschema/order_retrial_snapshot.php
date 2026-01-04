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

$db['order_retrial_snapshot']=array (
  'columns' => 
  array (
    'tid' => 
        array (
            'type' => 'int unsigned',
            'pkey' => true,
            'extra' => 'auto_increment',
            'editable' => false,
            'required' => true,
            'label' => '编号',
    ),
    'retrial_id' =>
        array (
            'type' => 'int(10)',
            'required' => true,
            'label' => '复审ID',
            'in_list' => false,
            'default_in_list' => true,
            'width' => 60,
            'hidden' => true,
            'order'=>10,
    ),
    'order_id' =>
        array (
            'type' => 'int unsigned',
            'default' => '0',
            'required' => true,
            'in_list' => false,
            'label' => '订单ID',
            'width' => 100,
            'order'=>20,
    ),
    'order_detail' =>
        array(
            'type' => 'longtext',
            'required' => false,
            'editable' => false,
            'label' => '订单信息',
            'width' => 100,
            'order'=>30,
    ),
    'new_order_detail' =>
        array(
            'type' => 'longtext',
            'required' => false,
            'editable' => false,
            'label' => '新订单信息',
            'width' => 100,
            'order'=>30,
    ),
    'dateline' => array(
          'type' => 'time',
          'default' => '0',
          'required' => true,
          'label' => '添加日期',
          'filtertype' => 'time',
          'filterdefault' => true,
          'in_list' => true,
          'default_in_list' => true,
          'width' => 130,
          'order'=>80,
    ), 
  ),
  'index' => array(
    'retrial_id' => array('columns' => array('retrial_id')),
    'order_id' => array('columns' => array('order_id')),
  ),
  'comment' => '复审订单快照表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);