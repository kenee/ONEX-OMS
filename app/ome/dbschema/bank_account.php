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

$db['bank_account']=array (
    'columns' =>
        array (
            'ba_id' =>
                array (
                    'type' => 'smallint(6)',
                    'required' => true,
                    'pkey' => true,
                    'editable' => false,
                    'in_list' => false,
                    'default_in_list' => true,
                    'extra' => 'auto_increment',
                    'comment' => '主键',
                ),
            'bank' =>
                array (
                    'type' => 'varchar(50)',
                    'editable' => false,
                    'in_list' => true,
                    'default_in_list' => true,
                    'label' => '开户银行',
                    'default' => '',
                    'comment' => '银行',
                ),
            'account' =>
                array (
                    'type' => 'varchar(50)',
                    'editable' => false,
                    'in_list' => true,
                    'default_in_list' => true,
                    'label' => '银行账号',
                    'default' => '',
                    'comment' => '银行账户',
                ),
            'holder' =>
                array (
                    'type' => 'varchar(50)',
                    'editable' => false,
                    'in_list' => true,
                    'default_in_list' => true,
                    'label' => '开户人',
                    'default' => '',
                    'comment' => '持有者',
                ),
            'phone' =>
                array (
                    'type' => 'varchar(50)',
                    'editable' => false,
                    'in_list' => true,
                    'default_in_list' => true,
                    'label' => '银行预留电话',
                    'default' => '',
                    'comment' => '联系电话',
                ),
        ),
    'index' =>
        array (
        ),
    'comment' => '银行账户信息',
    'engine' => 'innodb',
    'version' => '$Rev: 44513 $',
);
