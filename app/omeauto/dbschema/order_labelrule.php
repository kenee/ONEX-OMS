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

$db['order_labelrule'] = array(
    'columns' => array(
        'id' => array(
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'editable' => false,
            'order' => 1,
        ),
        'name' => array(
            'type' => 'varchar(30)',
            'required' => true,
            'editable' => false,
            'searchtype' => 'has',
            'filtertype' => 'normal',
            'filterdefault' => true,
            'in_list' => true,
            'default_in_list' => true,
            'width' => 130,
            'label' => '规则名称',
            'order' => 10,
        ),
        'config' => array(
            'type' => 'serialize',
            'editable' => false,
            'order' => 100,
            'label' => '规则内容',
            'in_list' => false,
            'default_in_list' => false,
        ),
        'select_label' => array(
            'type' => 'text',
            'editable' => false,
            'order' => 90,
            'label' => '关联标签',
            'in_list' => false,
            'default_in_list' => false,
        ),
        'memo' => array(
            'type' => 'text',
            'editable' => false,
            'label' => '简单说明',
            'order' => 80,
            'in_list' => false,
            'default_in_list' => false,
        ),
        'weight' => array(
            'type' => 'number',
            'required' => true,
            'editable' => false,
            'default' => '0',
            'in_list' => true,
            'default_in_list' => true,
            'width' => 90,
            'label' => '权重',
            'order' => 20,
        ),
        'org_id' => array (
            'type' => 'table:operation_organization@ome',
            'label' => '运营组织',
            'editable' => false,
            'width' => 110,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'in_list' => true,
            'default_in_list' => true,
            'order' => 30,
        ),
        'disabled' => array(
            'type' => 'bool',
            'required' => true,
            'editable' => false,
            'label' => '是否启用',
            'default' => 'false',
            'in_list' => false,
            'default_in_list' => false,
            'order' => 40,
        ),
        'create_time' => array(
            'type' => 'time',
            'label'  => '创建时间',
            'width' => 130,
            'editable' => false,
            'in_list' => true,
            'default_in_list' => true,
            'order' => 98,
        ),
        'last_modified' => array(
            'type' => 'time',
            'label' => '最后更新时间',
            'width' => 130,
            'editable' => false,
            'in_list' => true,
            'default_in_list' => true,
            'order' => 99,
        ),
    ),
    'comment' => '订单标记规则',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);