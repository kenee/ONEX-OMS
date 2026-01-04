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

$db['material_package_items'] = array(
    'columns' => array(
        'id'        => array(
            'type'     => 'int unsigned',
            'required' => true,
            'pkey'     => true,
            'extra'    => 'auto_increment',
            'label'    => 'ID',
            'width'    => 110,
            'hidden'   => true,
            'editable' => false,
        ),
        'mp_id'        => array(
            'type'            => 'table:material_package@console',
            'label'           => '组装单号',
            'default_in_list' => true,
            'in_list'         => true,
            'order' => 10,
            'width'           => 200,
        ),
        'bm_id'      => array(
            'type'            => 'table:basic_material@material',
            'label'           => '基础物料ID',
            'default_in_list' => true,
            'in_list'         => true,
            'order' => 20,
        ),
        'bm_bn'      => array(
            'type'            => 'varchar(255)',
            'label'           => '基础物料编码',
            'default_in_list' => true,
            'in_list'         => true,
            'order' => 20,
        ),
        'bm_name'      => array(
            'type'            => 'varchar(255)',
            'label'           => '基础物料名称',
            'default_in_list' => true,
            'in_list'         => true,
            'order' => 20,
        ),
        'number'      => array(
            'type'            => 'int',
            'label'           => '数量',
            'default_in_list' => true,
            'in_list'         => true,
            'order' => 20,
        ),
        'in_number'      => array(
            'type'            => 'int',
            'label'           => '入库数量',
            'default'         => 0,
            'default_in_list' => true,
            'in_list'         => true,
            'order' => 20,
        ),
        'out_number'      => array(
            'type'            => 'int',
            'label'           => '出库数量',
            'default'         => 0,
            'default_in_list' => true,
            'in_list'         => true,
            'order' => 20,
        ),
    ),
    'index'   => array(
        'idx_bm_bn'   => array('columns' => array('bm_bn'),),
    ),
    'engine'  => 'innodb',
    'version' => '$Rev:  $',
    'comment' => '组装单表明细',
);
