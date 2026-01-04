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

$db['check_memo']=array (
    'columns'=>
    array(
        'm_id' =>
            array (
                'type' => 'number',
                'required' => true,
                'editable' => false,
                'pkey' => true,
                'label' => 'ID',
                'extra' => 'auto_increment',
            ),
        'check_op_id' =>
            array (
                'type' => 'table:account@pam',
                'required' => true,
                'editable' => false,
                'default_in_list' => false,
                'in_list' => false,
            ),
    	'check_op_name' =>
            array (
                'type' => 'varchar(30)',
                'editable' => false,
                'default_in_list' => true,
                'in_list' => true,
                'label' => '校验员',
            ),
        'delivery_id' =>
            array (
                'type' => 'table:delivery@ome',
                'required'=> true,
                'default_in_list' => true,
                'in_list' => true,
                'label' => '发货单编号',
                'order' => 40,
            ),
        'reason_id' =>
            array (
                'type' => 'table:reason@tgkpi',
                'editable' => false,
                'default_in_list' => false,
                'in_list' => false,
            ),
        'memo' =>
            array (
                'type' => 'text',
                'editable' => false,
            ),
    	'addtime' =>
            array (
                'type' => 'time',
                'required'=> false,
                'default_in_list' => true,
                'in_list' => true,
                'filterdefault' => true,
                'filtertype' => 'has',
                'label' => '添加时间',
                'order' => 50,
            ),
    ),
    'comment' => '拣货绩效',
    'engine' => 'innodb',
    'version' => '$Rev:121321',
);
