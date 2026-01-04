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

/**
 * @Author: xueding@shopex.cn
 * @Vsersion: 2022/10/13
 * @Describe: 通知事件模板数据结构
 */

$db['event_group_template'] = array(
    'columns' => array(
        'group_id'   => array(
            'type'     => 'varchar(10)',
            'pkey'     => true,
            'width'    => 110,
            'hidden'   => true,
            'editable' => false,
        ),
        'event_type' => array(
            'type'            => 'text',
            'label'           => '触发事件',
            'comment'         => '触发事件',
            'editable'        => false,
            'in_list'         => false,
            'default_in_list' => false,
            'order'           => 10,
        ),
        'at_time'    => array(
            'type'            => 'TIMESTAMP',
            'label'           => '创建时间',
            'comment'         => '创建时间',
            'default'         => 'CURRENT_TIMESTAMP',
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 60,
        ),
        'up_time'    => array(
            'type'            => 'TIMESTAMP',
            'label'           => '修改时间',
            'comment'         => '修改时间',
            'default'         => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 70,
        ),
    
    ),
    'comment' => '监控邮件组关联模板',
    'index'   => array(),
    'engine'  => 'innodb',
    'version' => '$Rev:  $',
);
