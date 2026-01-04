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

/**
 * 福袋商品规则信息表
 * 20180314 by wangjianjun
 */

$db['luckybag_rules'] = array (
  'columns' => array(
    'lbr_id' => array(
        'type' => 'int unsigned',
        'required' => true,
        'pkey' => true,
        'extra' => 'auto_increment',
        'label' => '福袋规则主键ID',
        'hidden' => true,
        'editable' => false,
    ),
    'lbr_name' => array(
        'type' => 'varchar(200)',
        'required' => true,
        'label' => '福袋规则名称',
        'editable' => false,
    ),
    'sm_id' => array(
        'type' => 'int unsigned',
        'required' => true,
        'label' => '销售物料ID',
        'editable' => false,
    ),
    'bm_ids' => array(
        'type' => 'varchar(500)',
        'required' => true,
        'label' => '适用多个基础物料ID',
        'editable' => false,
    ),
    'sku_num' => array(
        'type' => 'number',
        'required' => true,
        'label' => 'sku数量',
        'editable' => false,
    ),
    'send_num' => array(
        'type' => 'number',
        'required' => true,
        'label' => '发货数量',
        'editable' => false,
    ),
    'price' => array(
        'type' => 'money',
        'required' => true,
        'label' => '单品价格',
        'editable' => false,
    ),
  ),
  'index' => array(
    'ind_sm_id' => array('columns' => array(0 => 'sm_id')),
    'ind_lbr_name' => array('columns' => array(0 => 'lbr_name')),
   ),
  'comment' => '福袋商品规则信息表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);