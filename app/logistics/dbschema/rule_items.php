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

$db['rule_items']=array (
    'columns' =>
    array (
        'item_id' =>
        array (
          'type' => 'int unsigned',
          'required' => true,
          'pkey' => true,
          'editable' => false,
          'extra' => 'auto_increment',
        ),
        'obj_id' =>
        array (
        'type' => 'table:rule_obj@logistics',
        'required' => true,
        'default' => 0,
        'editable' => false,
        'comment' => '规则对象ID',
        ),
        'min_weight' =>
        array (
            'type' => 'number',
            'editable' => false,
            'comment' => '最小重量',
        ),
        'max_weight' =>
        array(
            'type' => 'int',
            'editable' => false,
            'comment' => '最大重量',
        ),
        'corp_id'=>array (
            'type' => 'int',
            'editable' => false,
            'comment' => '物流公司ID',
        ),
        'second_corp_id'=>array (
            'type' => 'int',
            'editable' => false,
        ),
    ),
    'comment' => '规则明细',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);