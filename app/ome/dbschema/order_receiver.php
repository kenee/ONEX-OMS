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

$db['order_receiver'] = array(
    'columns' => array(
        'order_id' => array(
            'type'     => 'table:orders@ome',
            'required' => true,
            'default'  => 0,
            'editable' => false,
            'pkey'     => true,
            'comment'  => '订单号',
        ),
        'encrypt_source_data' => array (
            'type'     => 'text',
            'default'  => '',
            'label'    => '加密数据',
            'required' => false,
            'editable' => false,
        ),
        'platform_country_id' => array (
            'type' => 'varchar(30)',
            'editable' => false,
            'label' => '平台国家ID',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'platform_province_id' => array (
            'type' => 'varchar(30)',
            'editable' => false,
            'label' => '平台省ID',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'platform_city_id' => array (
            'type' => 'varchar(30)',
            'editable' => false,
            'label' => '平台市ID',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'platform_district_id' => array (
            'type' => 'varchar(30)',
            'editable' => false,
            'label' => '平台地区ID',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'platform_town_id' => array (
            'type' => 'varchar(30)',
            'editable' => false,
            'label' => '平台镇ID',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'ship_province' => array (
            'type' => 'varchar(30)',
            'editable' => false,
            'label' => '省',
            'comment' => '省',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'ship_city' => array (
            'type' => 'varchar(30)',
            'editable' => false,
            'label' => '市',
            'comment' => '市',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'ship_district' => array (
            'type' => 'varchar(30)',
            'editable' => false,
            'label' => '区',
            'comment' => '区',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'ship_town' => array (
            'type' => 'varchar(30)',
            'editable' => false,
            'label' => '乡镇',
            'comment' => '乡镇',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'ship_village' => array (
            'type' => 'varchar(50)',
            'editable' => false,
            'label' => '村',
            'comment' => '村',
            'in_list' => true,
            'default_in_list' => true,
        ),
    ),
    'engine'  => 'innodb',
    'version' => '$Rev: 40912 $',
    'comment' => '订单收货人信息表',
);