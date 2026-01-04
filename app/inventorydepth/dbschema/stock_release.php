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

$db['stock_release'] = array(
    'columns' => array(
        'id'   => array(
            'type'     => 'int unsigned',
            'extra'    => 'auto_increment',
            'pkey'     => true,
            'editable' => false,
            'label'    => '自增ID',
        ),
        'sales_material_bn'  => array(
            'type'          => 'varchar(255)',
            'label'         => '销售物料编码',
            'default'       => '',
            'is_title'      => true,
            'in_list'       => true,
            'default_in_list' => true,
            'order'         => 10,
            'searchtype'    => 'nequal',
            'filtertype'    => 'normal',
            'filterdefault' => true,
        ),
        'shop_id'  => array(
            'type'          => 'table:shop@ome',
            'label'         => '店铺名称',
            'in_list'       => true,
            'default_in_list' => true,
            'order'         => 20,
        ),
        'batch_queue'  => array(
            'type'          => 'varchar(255)',
            'label'         => '批次信息',
            'in_list'       => true,
            'default_in_list' => true,
            'order'         => 30,
            'searchtype'    => 'nequal',
            'filtertype'    => 'normal',
            'filterdefault' => true,
        ),
        'quantity'  => array(
            'type'          => 'int',
            'label'         => '发布数量',
            'in_list'       => true,
            'default_in_list' => true,
            'order'         => 30,
        ),
        'mode'  => array(
            'type'          => [
                'inc' => '增量',
                'ql' => '全量',
            ],
            'label'         => '发布方式',
            'in_list'       => true,
            'default_in_list' => true,
            'order'         => 30,
        ),
        'sync_status'  => array(
            'type'          => [
                'running' => '同步中',
                'succ' => '同步成功',
                'fail' => '同步失败',
            ],
            'label'         => '同步状态',
            'default'       => 'running',
            'in_list'       => true,
            'default_in_list' => true,
            'order'         => 35,
        ),
        'msg_id' => array(
            'type' => 'varchar(60)',
            'label' => 'msg_id',
            'in_list' => true,
            'default_in_list' => true,
            'default' => '',
            'order' => 36,
        ),
        'sync_msg'  => array(
            'type'          => 'varchar(255)',
            'label'         => '同步信息',
            'default'       => '',
            'in_list'       => true,
            'default_in_list' => true,
            'order'         => 36,
        ),
        'op_name'  => array(
            'type'          => 'varchar(255)',
            'label'         => '操作人',
            'in_list'       => true,
            'default_in_list' => true,
            'order'         => 40,
        ),
        'file_name'  => array(
            'type'          => 'varchar(255)',
            'label'         => '文件名',
            'in_list'       => true,
            'default_in_list' => true,
            'order'         => 50,
        ),
        'at_time'       => array(
            'type'            => 'TIMESTAMP',
            'label'           => '创建时间',
            'default'         => 'CURRENT_TIMESTAMP',
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 1000,
        ),
        'up_time'       => array(
            'type'            => 'TIMESTAMP',
            'label'           => '更新时间',
            'default'         => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'in_list'         => true,
            'default_in_list' => true,
            'order'           => 1010,
        ),
    ),
    'index'   => array(
        'idx_sales_material_bn'       => array('columns' => array('sales_material_bn')),
        'idx_batch_queue'       => array('columns' => array('batch_queue')),
        'idx_at_time'       => array('columns' => array('at_time')),
        'idx_up_time'       => array('columns' => array('up_time')),
    ),
    'engine'  => 'innodb',
    'commit'  => '库存发布，用于记录导入库存发布',
    'version' => 'Rev: 41996 $',
);