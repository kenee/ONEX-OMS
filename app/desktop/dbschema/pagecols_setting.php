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

$db['pagecols_setting'] = array(
    'columns' => array(
        'id' => array(
            'type' => 'int unsigned',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'label' => 'ID',
            'width' => 110,
            'hidden' => true,
            'editable' => false,
        ),
        'at_time' => array(
            'type' => 'TIMESTAMP',
            'label' => '创建时间',
            'default' => 'CURRENT_TIMESTAMP',
            'width' => 130,
            'editable' => false,
            'in_list' => true,
            'order' => 330,
            'filtertype' => 'normal',
        ),
        'up_time' => array(
            'type' => 'TIMESTAMP',
            'label' => '更新时间',
            'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'width' => 130,
            'editable' => false,
            'in_list' => true,
            'order' => 340,
            'filtertype' => 'normal',
        ),
        'tbl_name' => array(
            'type' => 'varchar(100)',
            'required' => true,
            'label' => '表名',
            'is_title' => true,
            'width' => 150,
            'editable' => false,
            'in_list' => true,
            'default_in_list' => true,
            'filtertype' => 'normal',
            'filterdefault' => true,
        ),
        'is_required' => array(
            'type' => array(
                '0' => '否',
                '1' => '是',
            ),
            'label' => '是否必填',
            'width' => 80,
            'default' => '0',
            'in_list' => true,
            'default_in_list' => true,
            'filtertype' => 'normal',
            'filterdefault' => true,
        ),
        'default_value' => array(
            'type' => 'varchar(255)',
            'label' => '默认值',
            'width' => 150,
            'in_list' => true,
            'default_in_list' => true,
        ),
        'col_key' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => '字段键',
            'width' => 150,
            'editable' => false,
            'in_list' => true,
            'default_in_list' => true,
            'filtertype' => 'normal',
            'filterdefault' => true,
        ),
    ),
    'index' => array(
        'ind_tbl_name' => array('columns' => array('tbl_name')),
        'ind_col_key' => array('columns' => array('col_key')),
        'ind_is_required' => array('columns' => array('is_required')),
        'ind_at_time' => array('columns' => array('at_time')),
        'ind_up_time' => array('columns' => array('up_time')),
    ),
    'comment' => '页面字段配置表',
    'charset' => 'utf8mb4',
    'engine' => 'innodb',
); 