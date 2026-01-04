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

$db['shop_dly_corp']=array (
  'columns' => 
  array (
    'shop_id' => 
    array (
      'type' => 'table:shop@ome',
      'required' => true,
      'pkey' => true,
      'editable' => false,
    ),
    'corp_id' =>
    array (
      'type' => 'table:dly_corp@ome',
      'required' => true,
      'pkey' => true,
      'editable' => false,
    ),
    'crop_name' =>
    array (
      'type' => 'varchar(200)',
      'editable' => false,
      'label' => '物流公司名称',
      'in_list' => true,
      'default_in_list' => true,
      'searchtype' => 'has',
      'filtertype' => 'normal',
      'filterdefault' => true,
      'is_title' => true,
    ),
  ),
  'index' =>
  array (
    'ind_corp_shop' =>
    array (
        'columns' =>
        array (
          0 => 'corp_id',
          1 => 'shop_id',
        ),
    ),
  ),
  'comment' => '前端店铺物流公司关联',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);