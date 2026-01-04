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

$db['operation_log'] = array(
    'columns' => array(
        'log_id' => array(
            'type'     => 'int unsigned',
            'required' => true,
            'pkey'     => true,
            'extra'    => 'auto_increment',
            'label'    => 'ID',
        ),
        'obj_type' => array(
            'type'     => 'varchar(30)',
            'required' => true,
        ),
        'obj_id' => array(
            'type'     => 'varchar(32)',
            'required' => true,
        ),
        'memo' => array(
            'type'     => 'longtext',
            'required' => true,
        ),
        'create_time' => array(
            'type'     => 'time',
            'required' => true,
        ),
        'op_id' => array(
            'type'     => 'mediumint unsigned',
            'required' => true,
        ),
        'op_name' => array(
            'type'     => 'varchar(100)',
            'required' => true,
        ),
        'operation' => array(
            'type' => 'varchar(50)',
            'required' => true,
        ),
    ),
    'comment' => '手工发布库存回写日志表',
    'index' => array(
        'idx_obj' => array('columns' => array('obj_id','obj_type')),
    ),
); 