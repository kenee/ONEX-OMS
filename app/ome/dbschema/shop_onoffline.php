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

$db['shop_onoffline']=array (
  'columns' => 
  array (
    'id' =>
    array (
      'type' => 'number',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
    ),
    'on_id' =>
    array (
      'type' => 'table:shop@ome',
      'editable' => false,
      'default_in_list' => true,
      'in_list' => true,
      'label' => '网店ID',
    ),
    'off_id' =>
    array (
      'type' => 'table:shop@ome',
      'editable' => false,
      'default_in_list' => true,
      'in_list' => true,
      'label' => '门店ID',
    ),
  ),
  'engine' => 'innodb',
  'comment' => '网店和门店的关联表',
  'version' => '$Rev:  $',
);