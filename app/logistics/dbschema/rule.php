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

$db['rule']=array (
  'columns' =>
  array (
    'rule_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'editable' => false,
      'extra' => 'auto_increment',
    ),
     'branch_id' =>
    array (
      'type' => 'table:branch@ome',
      'required' => true,
      'default' => 0,
      'editable' => false,
      'in_list'         => true,
      'default_in_list' => true,
      'label' => '仓库',
    ),
    'rule_name'=>
    array(
    'type'=>'varchar(200)',
    'label' => '规则名称',
    'in_list'         => true,
    'default_in_list' => true,
    ),

    'first_city'=>array(
        'type' => 'varchar(200)',
        'label' => '一级地区',
        'in_list' => true,
        'default_in_list' => true,
    ),
    
    'first_city_id'=>array (
      'type' => 'varchar(200)',
      'editable' => false,
      'comment' => '一级地区ID',

    ),

     'last_modified' =>
    array (
      'label' => '最后更新时间',
      'type' => 'last_modify',
      'width' => 130,
      'editable' => false,
      'in_list' => true,
    ),
    'disabled' =>
    array (
      'type' => 'bool',
      'required' => true,
      'default' => 'false',
      'editable' => false,
      'label' => '是否启用',
    ),
    'weight' =>
    array (
        'type' => 'number',
        'editable' => false,
        'in_list' => true,
        'default' => 0,
        'label' => '权重',
    ),
),

  'comment' => '规则',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);