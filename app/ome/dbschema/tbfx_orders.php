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

$db['tbfx_orders']=array(
  'columns' => array(
        'order_id' => array(
            'type'     => 'table:orders@ome',
            'required' => true,
            'default'  => 0,
            'editable' => false,
            'comment'  => '分销订单号',
        ),
        'fenxiao_order_id' => array(
            'type' => 'bigint(20)',
            'required' => true,
            'default'  => 0,
            'editable' => false,
            'comment'  => '淘宝分销供应商交易ID (用于发货 作为订单号回写到前端)',
        ),
        'tc_order_id' => array(
            'type'     => 'bigint(20)',
            'default'  => 0,
            'editable' => false,
            'comment'  => '淘宝分销的主订单ID (经销不显示)',
        ),
  ),
  'index' => 
  array(
    'uni_fx_orderid' =>
    array(
      'columns' =>
      array (
        0 => 'order_id',
      ),
      'prefix' => 'UNIQUE',
    ),
  ),
  'engine'  => 'innodb',
  'version' => '$Rev: 40912 $',
  'comment' => '淘宝分销主表',
);