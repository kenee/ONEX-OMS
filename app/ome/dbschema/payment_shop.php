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

$db['payment_shop']=array (
  'columns' => 
  array (
    'pay_bn' =>
    array (
      'type' => 'varchar(255)',
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
      'label' => '支付编号',
    ),
    'shop_id' =>
    array (
      'type' => 'table:shop@ome',
      'label' => '绑定店铺',
      'width' => 75,
      'editable' => false,
      'in_list' => true,
    ),
  ),
  'index' => 
  array (
    'ind_pay_bn_shop' =>
    array (
        'columns' =>
        array (
          0 => 'pay_bn',
          1 => 'shop_id',
        ),
        'prefix' => 'unique',
    ),
  ),
  'comment' => '支付方式和店铺关系表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);