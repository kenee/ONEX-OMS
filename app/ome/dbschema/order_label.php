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

// ====================================================
// == 此表已废弃 请转用sdb_ome_bill_label表 2023.09.26 ==
// == 此表已废弃 请转用sdb_ome_bill_label表 2023.09.26 ==
// == 此表已废弃 请转用sdb_ome_bill_label表 2023.09.26 ==
// ====================================================
$db['order_label'] = array (
    'columns' => array(
        'order_id' => array(
            'type' => 'table:orders@ome',
            'required' => true,
            'default'  => 0,
            'editable' => false,
            'label' => '订单ID',
            'width' => 120,
            'in_list' => true,
            'default_in_list' => true,
            'order' => 1,
        ),
        'label_id' => array (
            'type' => 'int(10)',
            'required' => true,
            'default' => 0,
            'editable' => false,
            'label'  => '标记ID',
            'width' => 90,
            'in_list' => true,
            'default_in_list' => true,
            'order' => 10,
        ),
        'label_name' => array (
            'type' => 'varchar(30)',
            'editable' => false,
            'label'  => '标记名称',
            'width' => 120,
            'in_list' => true,
            'default_in_list' => true,
            'order' => 12,
        ),
        'label_desc' => array (
            'type' => 'varchar(150)',
            'editable' => false,
            'label'  => '标记描述',
            'width' => 120,
            'in_list' => true,
            'default_in_list' => true,
            'order' => 12,
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
    ), 
    'index' => array(
        'in_label_id' => array(
            'columns'=> array('label_id')
        ),
    ),
    'comment' => '订单标记表',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);