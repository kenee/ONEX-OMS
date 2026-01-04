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

$db['shop_members']=array (
  'columns' => 
  array (
    'shop_id' => 
    array (
      'type' => 'table:shop@ome',
      'required' => true,
      'pkey' => true,
      'editable' => false,
    ),
    'shop_member_id' => 
    array (
      'type' => 'varchar(255)',
      'required' => true,
      'pkey' => true,
      'editable' => false,
    ),
    'member_id' => 
    array (
      'type' => 'table:members@ome',
      'required' => true,
      'editable' => false,
    ),
  ),
  'comment' => '前端店铺会员和ome会员对应关系表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);
