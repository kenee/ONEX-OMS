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

$db['dly_corp_channel']=array (
  'columns' => 
  array (
    'id' =>
    array (
      'type' => 'number',
      'required' => true,
      'pkey' => true,
      'editable' => false,
      'extra' => 'auto_increment',
    ),
    'corp_id' =>
    array (
      'type' => 'table:dly_corp@ome',
      'required' => true,
      'editable' => false,
    ),
    'shop_type' =>
    array (
      'type' => 'varchar(50)',
      'editable' => false,
      'label' => '店铺类型',
    ),
    'channel_id' =>
    array (
      'type' => 'table:channel@logisticsmanager',
      'editable' => false,
      'comment' => '来源主键',
      'label' => '面单来源',
      'width' => 130,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'prt_tmpl_id' =>
    array (
      'type' => 'table:express_template@logisticsmanager',
      'editable' => false,
    ),
  ), 
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);