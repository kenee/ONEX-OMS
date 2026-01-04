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

$db['store_cat']=array (
  'columns' =>
  array (
    'stc_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'width' => 110,
      'hidden' => true,
      'editable' => false,
      'pkey' => true,
      'extra' => 'auto_increment',
    ),
    'cat_id' =>
    array (
      'type' => 'int(10)',
      'label' => '类目ID',
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'cat_name' =>
    array (
      'type' => 'varchar(20)',
      'label' => '类目名称',
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'p_stc_id' =>
    array (
      'type' => 'int(10)',
      'label' => '上级类目ID',
      'editable' => false,
    ),
    'cat_path' =>
    array (
        'type' => 'varchar(255)',
        'width'=>300,
        'editable' => false,
        'comment' => '分类路径',
    ),
    'cat_grade' =>
    array (
        'type' => 'number',
        'editable' => false,
        'comment' => '路径级数',
    ),
    'haschild' => array(
        'type' => 'tinyint(1)',
        'default' => 0,
        'label' => '是否存在下级',
    ),
  ),
  'index' =>
    array (
        'ind_cat_id' =>
        array (
            'columns' =>
            array (
                0 => 'cat_id',
            ),
        ),
   ),
  'comment' => '淘宝门店类目表',
  'engine' => 'innodb',
);