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

$db['misc_task'] = array(
    'columns' => array(
        'id' => array(
            'type' => 'int unsigned',
            'required' => true,
            'pkey' => true,
            'editable' => false,
            'extra' => 'auto_increment',
        ),
        'obj_id' => array(
            'type' => 'int unsigned',
            'required' => true,
            'editable' => false,
            'comment' => '操作对象ID'
        ),
        'obj_type' => array(
            'type' => 'varchar(32)',
            'required' => true,
            'editable' => false,
            'comment' => '操作类型：timing_confirm_order->延时定时审单'
        ),
        'exec_time' => array(
            'type' => 'time',
            'required' => true,
            'editable' => false,
            'comment' => '执行时间'
        ),
        'extend_info' => array(
            'type' => 'text',
            'editable' => false,
            'label' => 'JSON扩展信息',
            'in_list' => false,
            'default_in_list' => false,
            'order' => 90,
        ),
        'create_time' => array(
            'type' => 'time',
            'editable' => false,
            'comment' => '创建时间'
        )
    ),
    'index' => array(
        'ind_exec_time' => array(
            'columns' => array('exec_time'),
        ),
        'ind_obj_type' => array(
            'columns' => array('obj_type', 'obj_id'),
            'prefix' => 'unique',
        ),
    ),
    'comment' => '定时触发表',
    'engine' => 'innodb',
    'version' => '$Rev: 44513 $',
);