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

$db['branchgroup'] = array(
    'columns' =>
        array(
            'bg_id' =>
                array(
                    'type' => 'int',
                    'required' => true,
                    'pkey' => true,
                    'extra' => 'auto_increment',
                    'editable' => false,
                ),
            'name' =>
                array(
                    'type' => 'varchar(200)',
                    'required' => true,
                    'editable' => false,
                    'in_list' => true,
                    'default_in_list' => true,
                    'width' => 130,
                    'label' => '分组名称',
                    'order' => 10
                ),
            'branch_group' =>
                array(
                    'type' => 'varchar(255)',
                    'default' => 0,
                    'editable' => false,
                    'width' => 200,
                    'label' => '仓库',
                    'order' => 30
                ),
            'createtime' =>
                array(
                    'type' => 'time',
                    'label' => '创建时间',
                    'width' => 130,
                    'editable' => false,
                    'in_list' => true,
                    'default_in_list' => false,
                    'order' => 40
                ),
            'last_modified' =>
                array(
                    'label' => '最后修改时间',
                    'type' => 'last_modify',
                    'width' => 130,
                    'editable' => false,
                    'in_list' => true,
                    'default_in_list' => true,
                    'order' => 50
                ),
        ),
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);