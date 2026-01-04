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

//管理员操作日志表
$db['user_logs'] = array(
    'columns' =>
        array(
            'log_id' =>
                array(
                    'type' => 'int unsigned',
                    'required' => true,
                    'pkey' => true,
                    'extra' => 'auto_increment',
                    'editable' => false,
                    'label' => '管理员操作日志ID',
                ),
            'obj_name' =>
                array(
                    'type' => 'varchar(30)',
                    'required' => true,
                    'editable' => false,
                    'comment' => '被操作用户',
                ),
            'obj_id' =>
                array(
                    'type' => 'table:account@pam',
                    'editable' => false,
                    'label' => '被操作用户ID',
                ),
            'op_id' =>
                array(
                    'type' => 'table:account@pam',
                    'editable' => false,
                    'required' => true,
                    'label' => '操作管理员ID',
                ),
            'op_name' =>
                array(
                    'type' => 'varchar(30)',
                    'editable' => false,
                    'required' => true,
                    'label' => '操作管理员',
                    'width' => 110,
                    'in_list' => true,
                    'default_in_list' => true,
                ),
            'operation_time' =>
                array(
                    'type' => 'time',
                    'required' => true,
                    'editable' => false,
                    'label' => '操作时间',
                    'width' => 110,
                    'in_list' => true,
                    'default_in_list' => true,
                ),
            'operation_type' =>
                array(
                    'type' => 'tinyint',//1-添加管理员 2-信息编辑 3-删除管理员 4-修改密码
                    'editable' => false,
                    'label' => '操作类型',
                    'required' => true,
                    'width' => 100,
                    'in_list' => true,
                    'default_in_list' => true,
                ),
            'operation_detail' =>
                array(
                    'type' => 'text',
                    //'required' => true,
                    'editable' => false,
                    'label' => '操作详情',
                    'width' => 140,
                    'in_list' => true,
                    'default_in_list' => true,
                ),
            'ip' =>
                array(
                    'type' => 'varchar(20)',
                    'label' => 'IP地址',
                    'editable' => false,
                ),
            'old_login_password' => array(
                'type' => 'varchar(32)',
                'label' => '旧登录密码',
                'editable' => false,
                'default' => '',
                'comment' => '旧登录密码（老密码）'
            )
        ),
    'index' =>
        array(
            'ind_obj_name' =>
                array(
                    'columns' =>
                        array(
                            0 => 'obj_name',
                        ),
                ),
        ),
    'comment' => '管理员操作日志表',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);