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

$db['goods_type_spec']=array (
  'columns' => 
  array (
    'spec_id' => 
    array (
      'type' => 'table:specification',
      'pkey' => true,
      'default' => 0,
      'editable' => false,
    ),
    'type_id' => 
    array (
      'type' => 'table:goods_type',
      'default' => 0,
      'pkey' => true,
      'editable' => false,
    ),
    'spec_style' => 
    array (
      'type' => 
      array (
        'select' => '下拉',
        'flat' => '平面',
        'disabled' => '禁用',
      ),
      'default' => 'flat',
      'required' => true,
      'editable' => false,
    ),
  ), 
  'comment' => '类型 规格索引表',
  'engine' => 'innodb',
  'version' => '$Rev: 40912 $',
);