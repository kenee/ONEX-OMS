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

$db['order_type'] = array(
    'columns' =>
    array(
        'tid' =>
        array(
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'editable' => false,
        ),
        'oid' =>
        array(
            'type' => 'number',
            'required' => true,
            'default' => '0',
            'editable' => false,
        ),
        'did' =>
        array(
            'type' => 'number',
            'required' => true,
            'default' => '0',
            'editable' => false,
        ),
        'bid' =>
        array(
            'type' => 'mediumint',
            'required' => true,
            'default' => '0',  
            'editable' => false,
        ),
        'name' =>
        array(
            'type' => 'varchar(200)',
            'required' => true,
            'editable' => false,
            'is_title' => true,
            'searchtype' => 'has',
            'filtertype' => 'normal',
            'filterdefault' => true,
            'in_list' => true,
            'default_in_list' => true,
            'width' => 130,
            'label' => '规则名称',
        ),
        'config' =>
        array(
            'type' => 'serialize',
            'editable' => false,
        ),
        'memo' =>
        array(
            'type' => 'text',
            'editable' => false,
        ),
        'weight' =>
        array(
            'type' => 'number',
            'required' => true,
            'editable' => false,
            'default' => '0',
            'in_list' => true,
            'default_in_list' => true,
            'width' => 80,
            'label' => '权重',
        ),
        'delivery_group' =>
        array(
            'type' => 'bool',
            'required' => true,
            'editable' => false,
            'default' => 'false',
            'width' => 100,
            'in_list' => true,
            'default_in_list' => false,
            'label' => '是否发货单分组',
        ),
        'group_type' =>
        array(
            'type' => array('order'=>'订单','sms'=>'短信','branch'=>'仓库','hold'=>'hold单'),
            'required' => true,
            'editable' => false,
            'default' => 'order',
            'width' => 100,
            'in_list' => false,
            'default_in_list' => false,
            'label' => '分组类型',
        ),
        'org_id' =>
        array (
          'type' => 'table:operation_organization@ome',
          'label' => '运营组织',
          'editable' => false,
          'width' => 60,
          'filtertype' => 'normal',
          'filterdefault' => true,
          'in_list' => true,
          'default_in_list' => true,
        ),
        'disabled' =>
        array(
            'type' => 'bool',
            'required' => true,
            'editable' => false,
            'default' => 'false',
        ),
    ),
    'comment' => '分组规则设置',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);