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

$db['expenses_export_log']=array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
    ),
    'export_type' => array(
      'type'            => array(
        'main' => '汇总',
        'items' => '明细',
      ),
      'label'           => '类型',
      'editable'        => false,
      'width'           => 120,
      'in_list'         => true,
      'default_in_list' => true,
      'filtertype'      => 'normal',
      'filterdefault'   => true,
    ),
    'filter' => array(
      'type'            => 'longtext',
      'label'           => '导出条件',
      'editable'        => false,
      'width'           => 120,
      'in_list'         => false,
      'default_in_list' => false,
    ),
    'export_time' => array(
      'type'            => 'time',
      'label'           => '导出时间',
      'editable'        => false,
      'width'           => 120,
      'in_list'         => true,
      'default_in_list' => true,
      'filtertype'      => 'normal',
      'filterdefault'   => true,
    ),
    'op_id' => array(
      'type'            => 'table:account@pam',
      'label'           => '操作人',
      'editable'        => false,
      'width'           => 60,
      'in_list'         => true,
      'default_in_list' => true,
    ),
  ),
  'index' => array(
    'ind_export_time' => array('columns' => array(0 => 'export_time')),
   ),
  'comment' => '导出日志表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);
