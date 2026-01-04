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

$db['order_batch']=array (
  'columns' => 
  array (
    'source_shop_id' => 
    array (
      'type' => 'table:shop@ome',
      'required' => true,
      'pkey' => true,
      'editable' => false,
      'in_list' => false,
      'label' => '来源店铺ID',
      'width' => 100,
    ),
    'source_account' =>
    array (
      'type' => 'varchar(50)',
      'required' => true,
      'pkey' => true,
      'editable' => false,
      'in_list' => true,
      'label' => '前台会员名',
      'width' => 100,
    ),
    'ship_info_md5' =>
    array (
      'type' => 'varchar(32)',
      'required' => true,
      'pkey' => true,
      'editable' => false,
      'in_list' => true,
      'label' => '收货人地址+姓名—+手机号码的MD5',
      'width' => 100,
    ),
    'order_date' =>
    array (
      'type' => 'varchar(8)',
      'editable' => false,
      'in_list' => true,
      'label' => '当天日期',
      'width' => 100,
    ),
    'ship_running_no' => 
    array (
      'type' => 'mediumint unsigned',
      'editable' => false,
      'in_list' => true,
    ),
    'increment' =>
    array (
      'type' => 'tinyint unsigned',
      'editable' => false,
      'in_list' => true,
    ),
  ),
  'comment' => '订单批次号计算',
  'engine' => 'innodb',
  'version' => '$Rev: 44513 $',
);
