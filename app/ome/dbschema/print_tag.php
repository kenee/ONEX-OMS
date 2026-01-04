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

$db['print_tag']=array (
  'columns' =>
  array (
    'tag_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'label' => 'ID',
      'width' => 110,
      'hidden' => true,
      'editable' => false,
    ),
    'name' =>
    array (
      'type' => 'varchar(200)',
      'required' => true,
      'default' => '',
      'editable' => false,
      'is_title' => true,
      'label' => '名称',
      'width' => 260,
      'in_list' => true,
      'default_in_list' => true,
      'searchtype' => 'has',
      'order' =>'1',
    ),
    'create_time' =>
    array (
      'type' => 'time',
      'editable' => false,
      'in_list' => false,
      'label' => '创建时间',
      'width' => 130,
      'in_list' => true,
      'default_in_list' => true,
      'order' =>'2',
    ),
    'last_modified' =>
    array (
      'type' => 'last_modify',
      'editable' => false,
      'label' => '最后更新时间',
     
    ),
    'intro' =>
    array (
      'type' => 'text',
      'editable' => false,
      'label' => '详细介绍',
    ),
    'config' =>
    array (
      'type' => 'longtext',
      'editable' => false,
      'label' => '配置信息',
    ),
  ),
  'comment' => '大头笔设置',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);