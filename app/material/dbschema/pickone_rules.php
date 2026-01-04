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
 * 多选一商品规则信息表
 * 20180314 by wangjianjun
 */

$db['pickone_rules'] = array (
  'columns' => array(
    'por_id' => array(
        'type' => 'int unsigned',
        'required' => true,
        'pkey' => true,
        'extra' => 'auto_increment',
        'label' => '多选一规则主键ID',
        'hidden' => true,
        'editable' => false,
    ),
    'sm_id' => array(
        'type' => 'int unsigned',
        'required' => true,
        'label' => '销售物料ID',
        'editable' => false,
    ),
    'bm_id' => array(
        'type' => 'varchar(500)',
        'required' => true,
        'label' => '适用多个基础物料ID',
        'editable' => false,
    ),
    'sort' => array(
        'type' => 'number',
        'required' => true,
        'label' => '排序',
        'default' => '0',
        'editable' => false,
    ),
    'select_type' => array(
        'type' => 'tinyint(1)',
        'default' => '1',
        'label' => '选择方式',
    ),
  ),
  'index' => array(
    'ind_sm_id' => array('columns' => array(0 => 'sm_id')),
   ),
  'comment' => '多选一商品规则信息表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);