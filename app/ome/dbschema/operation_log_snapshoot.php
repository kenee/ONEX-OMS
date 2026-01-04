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

$db['operation_log_snapshoot'] = array(
    'columns' => array(
        'id'        => array(
            'type'     => 'int unsigned',
            'pkey'     => true,
            'extra'    => 'auto_increment',
            'editable' => false,
        ),
        'log_id'    => array(
            'type'     => 'int unsigned',
            'editable' => false,
        ),
        'snapshoot' => array(
            'type'     => 'text',
            'label'    => '快照内容',
            'editable' => false,
        ),
        'updated' => array(
            'type'     => 'text',
            'label'    => '更新后数据',
            'editable' => false,
        ),
        'at_time'   => array(
            'type'    => 'TIMESTAMP',
            'label'   => '创建时间',
            'default' => 'CURRENT_TIMESTAMP',
        ),
        'up_time'   => array(
            'type'    => 'TIMESTAMP',
            'label'   => '更新时间',
            'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ),
    ),
    'index'   => array(
        'ind_log_id' => array(
            'columns' => array(
                0 => 'log_id',
            ),
        ),
    ),
    'comment' => '操作员记录快照扩展表',
    'engine'  => 'innodb',
    'version' => '$Rev:  $',
);
