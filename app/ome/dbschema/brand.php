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

$db['brand'] = array(
    'columns' => array(
        'brand_id'       => array(
            'type'     => 'number',
            'required' => true,
            'pkey'     => true,
            'extra'    => 'auto_increment',
            'label'    => '品牌id',
            'width'    => 150,
            'comment'  => '品牌id',
            'editable' => false,
        ),
        'brand_code'     => array(
            'type'            => 'varchar(50)',
            'label'           => '品牌编码',
            'width'           => 160,
            'comment'         => '品牌编码',
            'editable'        => false,
            'filtertype'      => 'normal',
            'filterdefault'   => true,
            'searchtype'      => 'nequal',
            'in_list'         => true,
            'default_in_list' => true,
        ),
        'brand_name'     => array(
            'type'            => 'varchar(50)',
            'label'           => '品牌名称',
            'width'           => 160,
            'is_title'        => true,
            'required'        => true,
            'comment'         => '品牌名称',
            'editable'        => false,
            'filtertype'      => 'normal',
            'filterdefault'   => true,
            'searchtype'      => 'has',
            'in_list'         => true,
            'default_in_list' => true,
        ),
        'brand_keywords' => array(
            'type'            => 'longtext',
            'label'           => '品牌别名',
            'width'           => 150,
            'comment'         => '品牌别名',
            'editable'        => false,
            'searchtype'      => 'has',
            'in_list'         => true,
            'default_in_list' => true,
            'filtertype'      => 'normal',
            'filterdefault'   => true,
            'searchtype'      => 'has',
        ),
        'brand_url'      => array(
            'type'            => 'varchar(255)',
            'label'           => '品牌网址',
            'width'           => 350,
            'comment'         => '品牌网址',
            'editable'        => false,
            'searchtype'      => 'has',
            'in_list'         => true,
            'default_in_list' => true,
        ),
        'brand_desc'     => array(
            'type'     => 'longtext',
            'comment'  => '品牌介绍',
            'editable' => false,
            'label'    => '品牌介绍',
        ),
        'brand_logo'     => array(
            'type'     => 'varchar(255)',
            'comment'  => '品牌图片标识',
            'editable' => false,
            'label'    => '品牌图片标识',
        ),
        'disabled'       => array(
            'type'     => 'bool',
            'default'  => 'false',
            'comment'  => '失效',
            'editable' => false,
            'label'    => '失效',
        ),
        'ordernum'       => array(
            'type'     => 'number',
            'label'    => '排序',
            'width'    => 150,
            'comment'  => '排序',
            'editable' => false,
        ),
    ),
    'comment' => '品牌表',
    'index'   => array(
        'ind_disabled'   => array(
            'columns' => array(
                0 => 'disabled',
            ),
        ),
        'ind_ordernum'   => array(
            'columns' => array(
                0 => 'ordernum',
            ),
        ),
        'ind_brand_code' => array(
            'columns' => array(
                0 => 'brand_code',
            ),
            'prefix'  => 'unique',
        ),
    ),
    'engine'  => 'innodb',
    'version' => '$Rev: 40654 $',
);
