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

$db['store_daliy']=array (
  'columns' =>
  array (
    'sd_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'width' => 110,
      'hidden' => true,
      'editable' => false,
      'pkey' => true,
      'extra' => 'auto_increment',
    ),
    'store_bn' =>
    array (
      'type' => 'varchar(20)',
      'required' => true,
      'label' => '门店编码',
      'editable' => false,
    ),
    'store_name' =>
    array (
      'type' => 'varchar(255)',
      'required' => true,
      'label' => '门店名称',
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'order_sum' => 
    array (
      'type' => 'number',
      'default' => 0,
      'required' => true,
      'label' => '订单总数',
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'sale_sum' => 
    array (
      'type' => 'number',
      'default' => 0,
      'required' => true,
      'label' => '销售货品数',
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'confirm_num' => 
    array (
      'type' => 'number',
      'default' => 0,
      'required' => true,
      'label' => '审核单量',
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'refuse_num' => 
    array (
      'type' => 'number',
      'default' => 0,
      'required' => true,
      'label' => '拒绝单量',
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'send_num' => 
    array (
      'type' => 'number',
      'default' => 0,
      'required' => true,
      'label' => '发货单量',
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'self_pick_rate' => 
    array (
      'type' => 'decimal(5,4)',
      'default' => 0.0000,
      'required' => true,
      'label' => '自提占比',
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'distribution_rate' => 
    array (
      'type' => 'decimal(5,4)',
      'default' => 0.0000,
      'required' => true,
      'label' => '配送占比',
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'verified_num' => 
    array (
      'type' => 'number',
      'default' => 0,
      'required' => true,
      'label' => '签收核销单量',
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'createtime' =>
    array (
      'type' => 'time',
      'required' => true,
      'label' => '统计日期',
      'width' => 130,
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
  ),
  'index' =>
  array (
    'ind_store_bn' =>
    array (
        'columns' =>
        array (
            0 => 'store_bn',
        ),
    ),
    'ind_createtime' =>
    array (
        'columns' =>
        array (
            0 => 'createtime',
        ),
    ),
  ),
  'comment' => '门店每日汇总统计表',
  'engine' => 'innodb',
);