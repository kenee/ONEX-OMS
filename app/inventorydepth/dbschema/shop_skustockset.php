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


$db['shop_skustockset'] = array(
    'columns' => array(
        'id' => array(
            'type' => 'int',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'label' => 'ID',
            'comment' => ''
        ),
        'skus_id' => array(
            'type' => 'table:shop_skus@inventorydepth',
            'label' => '店铺商品ID',
            //'in_list' => true,
            //'default_in_list' => true,
            //'order' => 5,
        ),
        'shop_product_bn' => array(
            'type'            => 'varchar(200)',
            'required'        => false,
            'label'           => 'OMS商品编码',
            'default'         => '',
            'in_list' => true,
            'default_in_list' => true,
            'filterdefault'   => true,
            'filtertype'      => 'normal',
            'order'           => 10
        ),
        'branch_id' => array(
            'type' => 'varchar(255)',
            'label' => '系统仓库ID',
            'in_list' => false,
            'default_in_list' => false,
        ),
        'branch_bn' => array(
            'type' => 'varchar(255)',
            'label' => '系统仓库ID',
            'in_list' => true,
            'default_in_list' => true,
            'filterdefault'   => true,
            'filtertype'      => 'normal',
            'order'           => '20'
        ),
        'stock' => array(
            'type' => 'number',
            'label' => '导入时库存',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'freeze' => array(
            'type' => 'number',
            'label' => '导入时冻结',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'stock_only' => array(
            'type' => 'number',
            'label' => '平台独立库存',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'last_modify' => array(
            'type' => 'last_modify',
            'label' => '修改时间',
            'in_list' => true,
            'default_in_list' => true,
        ),
    ),
    'index' => array(
        'idx_branch_bn_skus_id' => array(
            'columns' => array('branch_bn','skus_id'),
            'prefix' => 'unique',
        ),
        'idx_shop_product_bn' => array(
            'columns' => ['shop_product_bn']
        ),
        'idx_last_modify' => array(
            'columns' => ['last_modify']
        )
    ),
    'comment' => '店铺货品库存设置',
    'engine' => 'innodb',
    'version' => '$Rev: $'
);
