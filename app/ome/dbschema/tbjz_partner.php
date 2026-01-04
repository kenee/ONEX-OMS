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

$db['tbjz_partner']=array (
  'columns' =>
  array (
   'order_id' =>
    array (
      'type' => 'table:orders@ome',
      'required' => true,
      'default' => 0,
      'editable' => false,
    ),
    'tp_code' =>
    array (
      'type' => 'varchar(50)',
      'required' => true,
      'default' => 0,
      'editable' => false,
      'label'=>'物流商编码',
    ),
     'tp_name' => 
    array (
      'type' => 'varchar(50)',
      'default' => 0,
      'editable' => false,
      'label' => '物流商名称',
    ),
    'service_type' => 
    array (
      'type' => 'varchar(50)',
      'default' => 0,
      'editable' => false,
      'label' => '服务类型',
    ),
     'is_virtual_tp' => 
    array (
      'type' => 'bool',
      'default' => 'false',
      'label' => '是否虚拟物流商',
    ),
  ),
  
  'comment' => '淘宝家装服务商信息表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);
