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

$db['area_router']=array (
    'columns' =>
    array (
        'area_id' =>
        array (
            'type' => 'int unsigned',
            'required' => true,
            'pkey' => true,
            'editable' => false,
        ),
        'area_name' =>
        array (
            'type' => 'varchar(50)',
            'required' => true,
            'default' => '',

            'label'=>'地区',
            'width'=>100,
            'default_in_list'=>true,
            'in_list'=>true,
            'editable' => false,
        ),
        'first_dc' =>
        array (
            'type' => 'bool',
            'label'=>'大仓(非门店)优先',
            'width'=>100,
            'default_in_list'=>false,
            'in_list'=>false,
            'editable' => false,
        ),
         'router_area' =>
        array (
            'type' => 'text',
            'label'=>'路由地区',
            'width'=>400,
            'default_in_list'=>true,
            'in_list'=>true,
        ),
        'disabled' =>
        array (
            'type' => 'bool',
            'default' => 'false',
            'editable' => false,
        ),
    ),
    'comment' => '区域路由表',
);
