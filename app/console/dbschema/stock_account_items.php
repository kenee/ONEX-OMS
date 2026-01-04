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

$db['stock_account_items']=array (
  'columns' => 
                  array (
                    'items_id' => 
                    array (
                      'type' => 'number',
                      'required' => true,
                      'pkey' => true,
                      'extra' => 'auto_increment',
                      'editable' => false,
                    ),
                    'batch' => 
                    array (
                      'type' => 'varchar(64)',
                      'required' => false,
                      'editable' => false,
                      'searchtype' => 'has',
                      'filtertype' => 'normal',
                      'filterdefault' => true,
                      'in_list' => true,
                      'default_in_list' => true,
                      'width' => 150,
                      'label' => '批次号',
                    ),
                    'account_bn' => 
                    array (
                      'type' => 'varchar(32)',
                      'required' => true,
                      'editable' => false,
                      'searchtype' => 'has',
                      'filtertype' => 'normal',
                      'filterdefault' => true,
                      'in_list' => true,
                      'default_in_list' => true,
                      'width' => 150,
                      'label' => '商品货号',
                    ),
                    'account_time' => 
                    array (
                      'type' => 'time',
                      'label' => '日期',
                      'width' => 80,
                      'editable' => false,
                      'in_list' => true,
                      'default_in_list' => true,
                    ),
                    'original_goods_stock' =>
                    array (
                      'label' => '仓库良品数量',
                      'type' => 'mediumint',
                      'in_list' => true,
                      'default_in_list' => true,
                      'width' => 120,
                      'default' => 0,
                    ),
                    'account_goods_stock' =>
                    array (
                      'label' => '良品数量',
                      'type' => 'mediumint',
                      'in_list' => true,
                      'default_in_list' => true,
                      'width' => 120,
                      'default' => 0,
                    ),
                    'goods_diff_nums' =>
                    array (
                      'label' => '良品差异',
                      'type' => 'mediumint',
                      'in_list' => true,
                      'default_in_list' => true,
                      'width' => 100,
                      'default' => 0,
                    ),
                    'original_rejects_stock' =>
                    array (
                      'label' => '仓库不良品数量',
                      'type' => 'mediumint',
                      'in_list' => true,
                      'default_in_list' => true,
                      'width' => 120,
                      'default' => 0,
                    ),
                    'account_rejects_stock' =>
                    array (
                      'label' => '不良品数量',
                      'type' => 'mediumint',
                      'in_list' => true,
                      'default_in_list' => true,
                      'width' => 120,
                      'default' => 0,
                    ),
                    'rejects_diff_nums' =>
                    array (
                      'label' => '不良品差异',
                      'type' => 'mediumint',
                      'in_list' => true,
                      'default_in_list' => true,
                      'width' => 100,
                      'default' => 0,
                    ),
                    'wms_id' =>
                    array (
                      'label' => 'WMS',
                      'type' => 'varchar(32)',
                      'in_list' => true,
                      'default_in_list' => true,
                      'width' => 120
                    ),
                    'warehouse_code' =>
                        array (
                            'type' => 'varchar(32)',
                            'required' => true,
                            'in_list' => true,
                            'default_in_list' => true,
                            'label' => 'WMS仓库编码',
                        ),
                ),
  'index' =>
  array (
    'ind_bacth_bn' =>
    array (
        'columns' => array (
            'batch','account_bn'
         ),
    ),
	'ind_account_time' =>
    array (
        'columns' =>
        array (
          0 => 'account_time',
        ),
    ),
),
  'comment' => '盘点申请表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);

