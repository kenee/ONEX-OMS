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

$db['fukubukuro_log'] = array(
  'columns' => array(
    'log_id' => array(
        'type' => 'int unsigned',
        'required' => true,
        'pkey' => true,
        'extra' => 'auto_increment',
        'label' => '日志ID',
        'hidden' => true,
        'editable' => false,
    ),
    'order_id' => array (
        'type' => 'int unsigned',
        'required' => true,
        'label' => '订单ID',
        'editable' => false,
    ),
    'combine_id' => array (
        'type' => 'int unsigned',
        'required' => true,
        'label' => '福袋组合规则ID',
        'editable' => false,
    ),
    'sm_id' => array (
        'type' => 'int unsigned',
        'required' => true,
        'label' => '销售物料ID',
        'editable' => false,
    ),
    'bm_id' => array (
        'type' => 'int unsigned',
        'required' => true,
        'label' => '基础物料ID',
        'editable' => false,
    ),
    'quantity' => array (
        'type' => 'number',
        'required' => true,
        'label' => '分配数量',
        'editable' => false,
    ),
    'create_time' => array (
        'type' => 'time',
        'required' => true,
        'label' => '创建时间',
        'editable' => false,
    ),
  ),
  'index' => array(
    'ind_order_id' => array('columns' => array(0 => 'order_id')),
    'ind_sm_id' => array('columns' => array(0 => 'sm_id')),
    'ind_bm_id' => array('columns' => array(0 => 'bm_id')),
    'ind_combine_id' => array('columns' => array(0 => 'combine_id')),
  ),
  'comment' => '订单分配福袋日志表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);
