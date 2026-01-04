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

$db['autostore_rule']=array (
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
      'comment' => '仓库ID',
    ),
    'rule_name'=>
    array(
        'type'=>'varchar(200)',
        'label' => '规则名称',
        'in_list'         => true,
        'default_in_list' => true,
    ),
    'rule_type' =>
    array (
        'label' => '规则类型',
        'type' => array (
            'area' => '按区域覆盖',
            'lbs' => '按定位服务',
        ),
        'default' => 'area',
        'width' => 100,
        'editable' => false,
        'in_list'         => true,
        'default_in_list' => true,
    ),
    'disabled' =>
    array (
      'type' => 'bool',
      'required' => true,
      'default' => 'false',
      'editable' => false,
      'label' => '是否启用',
    ),
  ),
  'comment' => '门店优选规则',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);