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


$db['export_history'] =
    array(
        'columns' => array(
            'id'      => array(
                'label'           => 'ID',
                'type'            => 'number',
                'required'        => true,
                'extra'           => 'auto_increment',
                'pkey'            => true,
                'in_list'         => true,
                'default_in_list' => true,
                'width'           => 60,
                'order'           => 10,
            ),
            'task_name'    => array(
                'label'           => '任务名称',
                'type'            => 'varchar(50)',
                'in_list'         => true,
                'default_in_list' => true,
                'width'           => 240,
                'order'           => 20,
            ),
            'op_id'        => array(
                'type'            => 'table:account@pam',
                'label'           => '确认人',
                'editable'        => false,
                'width'           => 60,
                'filtertype'      => 'normal',
                'filterdefault'   => true,
                'in_list'         => true,
                'default_in_list' => true,
            ),
            'create_time'  => array(
                'label'           => '创建时间',
                'type'            => 'time',
                'in_list'         => true,
                'default_in_list' => true,
                'width'           => 150,
                'order'           => 60,
                'default'         => 0
            ),
            'file_name'    => array(
                'label'           => '文件名',
                'type'            => 'varchar(255)',
                'in_list'         => false,
                'default_in_list' => false,
                'width'           => 200,
                'order'           => 80,
            ),
        ),
        'comment' => '导出任务历史记录',
        'engine'  => 'innodb',
        'version' => '$Rev: 40654 $',
    );
