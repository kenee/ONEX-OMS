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

$db['return_payments']=array (
  'columns' => 
  array (
    'payment_id' => 
    array (
      'type' => 'table:payments@ome',
      'required' => true,
      'pkey' => true,
      'editable' => false,
      'comment' => '支付单ID',
    ),
    'return_id' => 
    array (
      'type' => 'table:return_product@ome',
      'required' => true,
      'pkey' => true,
      'editable' => false,
      'comment' => '售后ID',      
    ),
  ), 
  'engine' => 'innodb',
  'version' => '$Rev:  $',
  'comment' => '售后单与[退货]支付单(明细)对应表',
);