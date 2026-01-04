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

$db['store_regions']=array (
  'columns' =>
  array (
    'store_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'width' => 110,
      'hidden' => true,
      'editable' => false,
      'pkey' => true,
      'comment' => '门店ID',
    ),
    'region_1' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'width' => 110,
      'editable' => false,
      'default' => 0,
      'comment' => '一级地区',
    ),
    'region_2' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'width' => 110,
      'editable' => false,
      'default' => 0,
      'comment' => '二级地区',
    ),
    'region_3' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'width' => 110,
      'editable' => false,
      'default' => 0,
      'comment' => '三级地区',
    ),
    'region_4' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'width' => 110,
      'editable' => false,
      'default' => 0,
      'comment' => '四级地区',
    ),
    'region_5' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'width' => 110,
      'editable' => false,
      'default' => 0,
      'comment' => '五级地区',
    ),
  ),
  'comment' => '门店关联地区数据表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);