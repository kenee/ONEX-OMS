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

$db['spec_values']=array (
  'columns' => 
  array (
    'spec_value_id' => 
    array (
      'type' => 'number',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
    ),
    'spec_id' => 
    array (
      'type' => 'table:specification@ome',
      'default' => 0,
      'required' => true,
      'editable' => false,
    ),
    'spec_value' => 
    array (
      'type' => 'varchar(100)',
      'default' => '',
      'required' => true,
      'editable' => false,
      'is_title' => true,
    ),
    'alias' => 
    array (
      'type' => 'varchar(255)',
      'default' => '',
      'label' => '规格别名',
      'width' => 180,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'spec_image' => 
    array (
      'type' => 'varchar(11)',
      'default' => '',
      'required' => true,
      'editable' => false,
    ),
    'p_order' => 
    array (
      'type' => 'number',
      'default' => 50,
      'required' => true,
      'editable' => false,
    ),
  ), 
  'comment' => '商店中商品规格值',
  'engine' => 'innodb',
  'version' => '$Rev: 42046 $',
);