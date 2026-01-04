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

/**
 * 团购订单结构
 *
 * @author shiyao744@sohu.com
 * @version 0.1b
 */
$db['order_groupon'] = array(
    'columns' =>
    array(
        'order_groupon_id' =>
        array(
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'editable' => false,
        ),
        'name' =>
        array(
            'type' => 'varchar(255)',
            'required' => true,
            'editable' => false,
            'default_in_list' => true,
            'in_list' => true,
         	'label' => '标题',
        ),
        'shop_id' =>
	    array (
	      'type' => 'table:shop@ome',
	      'label' => '来源店铺',
	      'width' => 75,
	      'editable' => false,
	      'in_list' => true,
	      'default_in_list' => true,
	      'filtertype' => 'normal',
	      'filterdefault' => true,
	    ),
	     'create_time' =>
        array(
            'type' => 'time',
            'required' => true,
            'editable' => false,
            'in_list' => true,
            'default_in_list' => true,
            'label' => '创建时间',
            'comment' => '创建时间',
        ),
        'opt_id' =>
        array(
            'type' => 'number',
            'required' => true,
            'editable' => false,
            'in_list' => false,
        ),
        'opt_name' =>
        array(
            'type' => 'varchar(64)',
            'required' => true,
            'editable' => false,
            'in_list' => true,
            'default_in_list' => true,
            'label' => '操作人',
            'comment' => '操作人',
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
    ),
    'comment' => '订单批量导入',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);