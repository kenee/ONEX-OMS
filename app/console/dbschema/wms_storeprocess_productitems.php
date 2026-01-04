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

$db['wms_storeprocess_productitems'] = array( 
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
        'wsp_id'        => array(
            'type'            => 'table:wms_storeprocess@console',
            'label'           => '第三方加工单',
        ),
        'item_code'        => array(
            'type'            => 'varchar(255)',
            'default'         => '',
            'label'           => 'erp系统商品编码',
        ),
        'item_id'        => array(
            'type'            => 'varchar(255)',
            'default'         => '',
            'label'           => '仓储系统商品ID',
        ),
        'inventory_type'        => array(
            'type'            => 'varchar(25)',
            'default'         => '',
            'label'           => '库存类型',
        ),
        'quantity'        => array(
            'type'            => 'number',
            'default'         => 0,
            'label'           => '数量',
        ),
        'product_date'        => array(
            'type'            => 'varchar(25)',
            'default'         => '',
            'label'           => '商品生产日期',
        ),
        'expire_date'        => array(
            'type'            => 'varchar(25)',
            'default'         => '',
            'label'           => '商品过期日期',
        ),
        'produce_code'        => array(
            'type'            => 'varchar(255)',
            'default'         => '',
            'label'           => '生产批号',
        ),
        'batch_code'        => array(
            'type'            => 'varchar(25)',
            'default'         => '',
            'label'           => '批次编码',
        ),
        'remark'        => array(
            'type'            => 'text',
            'default'         => '',
            'label'           => '备注',
        ),
    ),
    'index'   => array(
        'idx_item_code'     => array('columns' => array('item_code')),
        'idx_item_id'     => array('columns' => array('item_id')),
    ),
    'engine'  => 'innodb',
    'version' => '$Rev:  $',
    'comment' => '第三方加工单商品',
);
