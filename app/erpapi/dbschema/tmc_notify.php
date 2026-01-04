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

$db['tmc_notify'] = array(
    'columns' => array(
        'id'   => array(
            'type'     => 'bigint unsigned',
            'extra'    => 'auto_increment',
            'pkey'     => true,
            'editable' => false, 
            'label'    => '自增ID',
        ),
        'tmc_key'       => array(
            'type'            => 'varchar(255)',
            'label'           => '存储索引',
            'default'         => '',
        ),
        'tid'       => array(
            'type'            => 'varchar(255)',
            'label'           => '订单号',
            'default'         => '',
        ),
        'oid'       => array(
            'type'            => 'varchar(255)',
            'label'           => '子单号',
            'default'         => '',
        ),
        'sdf'       => array(
            'type'            => 'text',
            'label'           => '消息通知内容',
            'default'         => '',
        ),
        'at_time'       => array(
            'type'            => 'TIMESTAMP',
            'label'           => '创建时间',
            'default'         => 'CURRENT_TIMESTAMP',
        ),
        'up_time'       => array(
            'type'            => 'TIMESTAMP',
            'label'           => '更新时间',
            'default'         => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ),
    ),
    'index'   => array(
        'idx_tmc_key'       => array('columns' => array('tmc_key')),
        'idx_tid'           => array('columns' => array('tid')),
        'idx_at_time'       => array('columns' => array('at_time')),
        'idx_up_time'       => array('columns' => array('up_time')),
    ),
    'comment' => 'tmc 消息通知',
    'engine'  => 'innodb',
    'version' => '$Rev: 41996 $',
);
