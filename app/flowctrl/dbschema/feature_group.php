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
 * 类目数据结构
 *
 * @author kamisama.xia@gmail.com 
 * @version 0.1
 */

$db['feature_group']=array (
  'columns' =>
  array (
    'ftgp_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'width' => 110,
      'hidden' => true,
      'editable' => false,
    ),
    'ftgp_name' => 
    array (
      'type' => 'varchar(200)',
      'required' => true,
      'editable' => false,
      'is_title' => true,
      'searchtype' => 'has',
      'filtertype' => 'normal',
      'filterdefault' => true,
      'in_list' => true,
      'default_in_list' => true,
      'width' => 150,
      'label' => '类目',
    ),
    'config' =>
    array (
      'type' => 'text',
      'editable' => false,
    ),
    'disabled' => 
    array (
      'type' => 'bool',
      'required' => true,
      'editable' => false,
      'default' => 'false',
    ),
  ),
'index' =>
  array (
    'ind_ftgp_name' =>
    array (
        'columns' =>
        array (
          0 => 'ftgp_name',
        ),
        'prefix' => 'unique',
    ),
  ),
  'comment' => '特性类目配置表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);