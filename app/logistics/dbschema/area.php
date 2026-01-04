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

$db['area']=array (
    'columns' =>
    array (
        'area_id' =>
        array (
            'type' => 'int unsigned',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'editable' => false,
        ),

        'local_name' =>
        array (
            'type' => 'varchar(50)',
            'required' => true,
            'default' => '',

            'label'=>'名称',
            'width'=>100,
            'default_in_list'=>true,
            'in_list'=>true,
            'editable' => false,
        ),

        'region_id' =>
        array (
            'type' => 'varchar(255)',
            'editable' => false,
            'comment' => '区域ID',
        ),

         'region_name' =>
        array (
            'type' => 'longtext',
            'label'=>'包含区域名称',
            'width'=>100,
            'default_in_list'=>true,
            'in_list'=>true,
             'width'=>400,
        ),
        'ordernum' =>
        array (
            'type' => 'number',
            'editable' => true,
            'comment' => '排序',
        ),
        'disabled' =>
        array (
            'type' => 'bool',
            'default' => 'false',
            'editable' => false,
        ),
    ),
    'comment' => '区域',
);
