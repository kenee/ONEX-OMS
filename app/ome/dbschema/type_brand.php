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

$db['type_brand']=array (
  'columns' => 
  array (
    'type_id' => 
    array (
      'type' => 'table:goods_type@ome',
      'required' => true,
      'default' => 0,
      'pkey' => true,
      'editable' => false,
    ),
    'brand_id' => 
    array (
      'type' => 'table:brand@ome',
      'required' => true,
      'default' => 0,
      'pkey' => true,
      'editable' => false,
    ),
    'brand_order' => 
    array (
      'type' => 'number',
      'editable' => false,
    ),
  ), 
  'comment' => '类型品牌关系表',
  'engine' => 'innodb',
  'version' => '$Rev: 40654 $',
);