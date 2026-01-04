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

$db['useful_life']=array (
    'columns' =>
        array (
            'life_id' =>
                array (
                    'type' => 'bigint unsigned',
                    'required' => true,
                    'pkey' => true,
                    'extra' => 'auto_increment',
                ),
            'purchase_code' =>
                array (
                    'type' => 'varchar(64)',
                    'required' => true,
                    'label' => '购买批次',
                    'is_title' => true,
                    'default_in_list'=>true,
                    'in_list'=>true,
                    'width' => 125,
                    'filtertype' => 'normal',
                    'filterdefault' => true,
                    'searchtype'      => 'nequal',
                ),
            'produce_code' =>
                array (
                    'type' => 'varchar(32)',
                    'label' => '生产批次',
                    'default' => '',
                    'default_in_list'=>true,
                    'in_list'=>true,
                ),
            'product_id' =>
                array (
                    'type' => 'table:basic_material@material',
                    'required' => true,
                    'default_in_list'=>true,
                    'in_list'=>true,
                    'label' => '基础物料名称',
                ),
            'bn' =>
                array (
                    'type' => 'varchar(60)',
                    'label' => '基础物料编码',
                    'width' => 150,
                    'editable' => false,
                    'default_in_list'=>true,
                    'in_list'=>true,
                    'filtertype' => 'normal',
                    'filterdefault' => true,
                    'searchtype'      => 'nequal',
                ),
            'branch_id' =>
                array (
                    'type' => 'table:branch@ome',
                    'required' => true,
                    'label' => '仓库名称',
                    'filtertype' => 'normal',
                    'filterdefault' => true,
                    'default_in_list'=>true,
                    'in_list'=>true,
                ),
            'create_time' =>
                array (
                    'type' => 'time',
                    'default_in_list'=>true,
                    'in_list'=>true,
                    'label' => '创建时间',
                ),
            'num' =>
                array (
                    'type' => 'int',
                    'label' => '批次数量',
                    'required' => true,
                    'default_in_list'=>true,
                    'in_list'=>true,
                ),
            'product_time' =>
                array (
                    'type' => 'time',
                    'label' => '生产时间',
                    // 'required' => true,
                    'default_in_list'=>true,
                    'in_list'=>true,
                ),
            'expire_time' =>
                array (
                    'type' => 'time',
                    'label' => '到期时间',
                    // 'required' => true,
                    'default_in_list'=>true,
                    'in_list'=>true,
                ),
        ),
    'index' =>
        array (
            'ind_branch_product_purchase' =>
                array (
                    'columns' =>
                        array (
                            'branch_id', 'product_id', 'purchase_code'
                        ),
                    'prefix' => 'unique'
                ),
            'ind_purchase_code' =>
                array (
                    'columns' =>
                        array (
                            0 => 'purchase_code',
                        ),
                ),
            'ind_create_time' =>
                array (
                    'columns' =>
                        array (
                            0 => 'create_time',
                        ),
                ),
            'ind_expire_time' =>
                array (
                    'columns' =>
                        array (
                            0 => 'expire_time',
                        ),
                ),
            'ind_bn' =>
                array (
                    'columns' =>
                        array (
                            0 => 'bn',
                        ),
                ),
        ),
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);