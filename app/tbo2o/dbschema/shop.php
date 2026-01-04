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

$db['shop'] = array(
    'columns' => array(
        'id' => array(
            'type' => 'int unsigned',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'label' => app::get('tbo2o')->_('ID'),
        ),
        'company_name' => array(
            'type' => 'varchar(255)',
            'order' => 20,
            'label' => app::get('tbo2o')->_('商户名称'),
        ),
        'company_content' => array(
            'type' => 'varchar(255)',
            'order' => 20,
            'label' => app::get('tbo2o')->_('商户介绍'),
        ),
        'shop_id' => array(
            'type' => 'varchar(32)',
            'filterdefault' => true,
            'filtertype' => true,
            'label' => app::get('tbo2o')->_('前端店铺ID'),
        ),
        'shop_bn' => array(
            'type' => 'bn',
            'in_list' => true,
            'filterdefault' => true,
            'filtertype' => true,
            'label' => app::get('tbo2o')->_('前端店铺编码'),
        ),
        'shop_name' => array(
            'type' => 'varchar(255)',
            'order' => 20,
            'label' => app::get('tbo2o')->_('前端店铺名称'),
        ),
        'branch_bn' =>
        array (
            'type' => 'varchar(32)',
            'label' => '仓库编号',
        ),
        'create_time' => array(
            'type' => 'time',
            'default' => 0,
            'in_list' => true,
            'default_in_list' => true,
            'label' => app::get('tbo2o')->_('创建时间'),
        ),
    ),
    'index' =>
    array (
        'ind_shop_id' => array ( 'columns' => array ( 'shop_id',)),
        'ind_branch_bn' => array ( 'columns' => array ( 'branch_bn',)),
    ),
    'engine'  => 'innodb',
    'version' => '$Rev: $',
    'comment' => app::get('tbo2o')->_('全渠道店铺表'),
);