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
 * 人工库存预占组表
 * by wangjianjun 20180227
 */

$db['product_stock_artificial_freeze_group']=array (
  'columns' =>
  array (
    'group_id' => array(
        'type'     => 'int unsigned',
        'required' => true,
        'pkey'     => true,
        'extra'    => 'auto_increment',
        'editable' => false,
    ),
    'group_name' => array(
        'type' => 'varchar(50)',
        'comment' => '组名',
        'label' => '组名',
        'editable' => false,
        'required' => true,
    ),
  ),
    'index' => array (
        'ind_group_name' =>
        array (
            'columns' =>
            array (
                0 => 'group_name',
            ),
        ),
    ),
  'comment' => '人工库存预占组表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);
