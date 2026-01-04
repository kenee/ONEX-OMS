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

$db['tbfx_order_objects']=array(
  'columns' => array(
          'order_id' => array(
            'type'     => 'table:orders@ome',
            'required' => true,
            'default'  => 0,
            'editable' => false,
            'comment'  => '分销订单号',
          ),
          'obj_id' => array(
            'type' => 'table:order_objects@ome',
            'required' => true,
            'default'  => 0,
            'editable' => false,
            'comment'  => '订单obj主键ID',
          ),
          'fx_oid' => array(
            'type'     => 'bigint(20)',
            'default'  => 0,
            'editable' => false,
            'comment'  => '淘宝分销子采购单id',
          ),
        'tc_order_id' => array(
            'type'     => 'bigint(20)',
            'default'  => 0,
            'editable' => false,
            'comment'  => '淘宝分销的子订单ID (经销不显示)',
        ),
        'buyer_payment' => array(
            'type'     => 'money',
            'default'  => 0,
            'editable' => false,
            'comment'  => '代销价(买家支付给分销商的总金额)',
        ),      
        'cost_tax' => array(
            'type'     => 'money',
            'default'  => 0,
            'editable' => false,
            'comment'  => '发票应开金额',
        ),      
  ),
  'engine'  => 'innodb',
  'version' => '$Rev: 40912 $',
  'comment' => '淘宝分销主表',
);