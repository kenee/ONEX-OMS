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

$db['operation'] = array(
    'columns' => array(
        'operation_id'               => array(
            'type'     => 'number',
            'required' => true,
            'pkey'     => true,
            'extra'    => 'auto_increment',
            'editable' => false,
        ),
        'tgstockcost_cost'           => array(
            'type'     => 'char(10)',
            'required' => true,
            'editable' => false,
            'comment'  => '存货计价法',
        ),
        'tgstockcost_get_value_type' => array(
            'type'     => 'char(10)',
            'editable' => false,
            'comment'  => '盘点/调账成本取值',
        ),
        'tgstockcost_return_cost' => array(
            'type'     => 'char(10)',
            'editable' => false,
            'comment'  => '退货成本取值',
        ),
        'tgstockcost_branch_cost' => array(
            'type'     => 'char(10)',
            'editable' => false,
            'comment'  => '仓库成本计算方式',
        ),
        'install_time'               => array(
            'type'     => 'time',
            'required' => true,
            'editable' => false,
            'comment'  => '安装时间',
        ),
        'end_time'                   => array(
            'type'     => 'time',
            'editable' => false,
            'comment'  => '结束时间',
        ),
        'op_id'                      => array(
            'type'     => 'table:account@pam',
            'editable' => false,
        ),
        'op_name'                    => array(
            'type'     => 'varchar(30)',
            'editable' => false,
        ),
        'operate_time'               => array(
            'type'     => 'time',
            'required' => true,
            'editable' => false,
            'comment'  => '操作时间',
        ),
        'memo'                       => array(
            'type'     => 'text',
            'editable' => false,
        ),
        'status'                     => array(
            'type'  => array(
                '0' => '历史成本状态',
                '1' => '当前成本状态',
            ),
            'label' => '当前成本或历史成本的标识',
        ),
        'type'                       => array(
            'type'    => array(
                '1' => '成本设置变更',
                '2' => '成本设置期初',
            ),
            'label'   => '日志类型',
            'default' => '1',
        ),
    ),
    'index'   => array(
        'idx_install_time' => array('columns' => array('install_time')),
        'idx_end_time'     => array('columns' => array('end_time')),
        'status'           => array('columns' => array('status')),
    ),
    'comment' => '成本配置信息表',
    'engine'  => 'innodb',
    'version' => '$Rev:  $',
);
