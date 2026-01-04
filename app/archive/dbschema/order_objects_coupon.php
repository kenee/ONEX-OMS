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

$db['order_objects_coupon'] = array(
    'columns' => array(
        'id' => array(
            'type' => 'int unsigned',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'label' => 'ID',
            'width' => 110,
            'hidden' => true,
            'editable' => false,
        ),
        'order_id' => array(
            'type' => 'int unsigned',
            'editable' => false,
            'label' => '订单ID',
        ),
        'order_bn' => array(
            'type' => 'varchar(32)',
            'in_list' => true,
            'label' => '订单号',
            'editable' => false,
            'default_in_list' => true,
        ),
        'num' => array(
            'type' => 'number',
            'editable' => false,
            'in_list' => true,
            'label' => '购买数量',
            'comment' => '购买数量',
            'default_in_list' => true,
        ),
        'material_name' => array(
            'type' => 'varchar(200)',
            'required' => true,
            'label' => '基础物料名称',
            'is_title' => true,
            'default_in_list' => true,
            'width' => 260,
            'searchtype' => 'has',
            'editable' => false,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'in_list' => true,
        ),
        'material_bn' => array(
            'type' => 'varchar(200)',
            'label' => '物料编码',
            'width' => 120,
            'editable' => false,
            'in_list' => true,
            'default_in_list' => true,
            'searchtype' => 'nequal',
            'filtertype' => 'normal',
            'filterdefault' => true,
        ),
        'oid' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'editable' => false,
            'label' => '子订单号',
        ),
        'create_time' => array(
            'type' => 'time',
            'label' => '下单时间',
            'width' => 130,
            'editable' => false,
            'filtertype' => 'time',
            'filterdefault' => true,
            'in_list' => true,
            'default_in_list' => true,
        ),
        'shop_id' => array(
            'type' => 'varchar(50)',
            'label' => '店铺id',
            'width' => 75,
            'editable' => false,
            'in_list' => false,
        ),
        'shop_type' => array(
            'type' => 'varchar(50)',
            'label' => '店铺类型',
            'width' => 75,
            'editable' => false,
            'in_list' => false,
        ),
        'addon' => array(
            'type' => 'serialize',
            'editable' => false,
        ),
        'source' => array(
            'type' => array(
                'local' => '本地创建',
                'rpc' => 'api请求',
                'push' => '矩阵推送',
            ),
            'default' => 'local',
            'label' => '来源',
        ),
        'org_id' => array(
            'type' => 'int unsigned',
            'label' => '运营组织',
            'editable' => false,
            'width' => 60,
            'filtertype' => 'normal',
            'filterdefault' => true,
            'in_list' => true,
            'default_in_list' => true,
        ),
        'archive_time' => array(
            'type' => 'int unsigned',
            'label' => '归档时间',
            'width' => 130,
            'editable' => false,
            'in_list' => true,
            'filtertype' => 'time',
            'filterdefault' => true,
        ),
    ),
    'index' => array(
        'idx_oid' => array('columns' => array('oid')),
        'idx_order_bn' => array('columns' => array('order_bn')),
        'idx_material_bn' => array('columns' => array('material_bn')),
        'idx_order_id' => array('columns' => array('order_id')),
        'idx_archive_time' => array('columns' => array('archive_time')),
    ),
    'comment' => '归档平台订单汇总优惠金额',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
); 