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

$db['rule_shop']=array (
    'columns' =>
    array (
        'id' =>
        array (
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'editable' => false,
        ),
        'rule_id' =>
        array (
            'type' => 'table:rule@logistics',
            'required' => true,
            'editable' => false,
        ),
        'shop_id' =>
        array (
            'type' => 'table:shop@ome',
            'required' => true,
            'editable' => false,
        ),
        'branch_id' =>
        array (
            'type' => 'table:branch@ome',
            'required' => true,
            'editable' => false,
        ),
    ),
    'index' =>
    array (
        'ind_rule_id_shop_id' =>
        array (
            'columns' =>
            array (
                0 => 'rule_id',
                1 => 'shop_id',
            ),
            'prefix' => 'unique',
        ),
    ),
    'comment' => '优选规则与店铺关系表',
    'engine' => 'innodb',
    'version' => '$Rev: 51996',
);