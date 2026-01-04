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

$db['wms_transferorder_items'] = array(
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
        'wst_id'        => array(
            'type'            => 'table:wms_transferorder@console',
            'label'           => '第三方入库单',
        ),
        'product_bn'        => array(
            'type'            => 'varchar(255)',
            'default'         => '',
            'label'           => '货品编码',
        ),
        'normal_num'        => array(
            'type'            => 'varchar(255)',
            'default'         => 0,
            'label'           => '良品数',
        ),
        'defective_num'        => array(
            'type'            => 'varchar(255)',
            'default'         => 0,
            'label'           => '不良品数',
        ),
        'wms_item_id'        => array(
            'type'            => 'varchar(255)',
            'default'         => '',
            'label'           => '第三方货品编码',
        ),
        'in_count'        => array(
            'type'            => 'varchar(255)',
            'default'         => 0,
            'label'           => '入库数',
        ),
        'plan_count'        => array(
            'type'            => 'varchar(255)',
            'default'         => 0,
            'label'           => '计划数',
        ),
    ),
    'index'   => array(
        'idx_product_bn'     => array('columns' => array('product_bn')),
        'idx_wms_item_id'     => array('columns' => array('wms_item_id')),
    ),
    'engine'  => 'innodb',
    'version' => '$Rev:  $',
    'comment' => '第三方转储单明细',
);
