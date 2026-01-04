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

$db['dly_corp_items']=array (
  'columns' =>
  array (

    'corp_id' =>
    array (
      'type' => 'table:dly_corp@ome',
      'required' => true,
      'default' => 0,
      'editable' => false,
      'pkey' => true,
    ),
    'region_id' =>
    array (
      'type' => 'table:regions@eccommon',
      'required' => true,
      'default' => '0',
      'editable' => false,
      'pkey' => true,
    ),

   'areagroupbakid' =>
    array (
      'type' => 'number',
      'required' => true,
      'default' => '0',
      'editable' => false,

    ),

    'firstunit' =>
    array (
      'type' => 'number',
      'editable' => false,
      'default' => 0,
      'required' => true,
    ),
    'continueunit' =>
    array (
      'type' => 'number',
      'editable' => false,
      'default' => 0,
      'required' => true,
    ),
    'firstprice' =>
    array (
      'type' => 'money',
      'editable' => false,
    ),
    'continueprice' =>
    array (
      'type' => 'money',
      'editable' => false,
    ),
    'dt_expressions' =>
    array (
      'type' => 'longtext',
      'editable' => false,
    ),
    'dt_useexp' =>
    array (
      'type' => 'bool',
      'required' => true,
      'default' => 'false',
      'editable' => false,
    ),
    ),
  'comment' => '物流公司明细',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);