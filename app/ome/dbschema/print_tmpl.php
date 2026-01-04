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

$db['print_tmpl']=array (
  'columns' =>
  array (
    'prt_tmpl_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'label' => app::get('base')->_('ID'),
      'width' => 75,
      'editable' => false,
    ),
    'prt_tmpl_title' =>
    array (
      'type' => 'varchar(100)',
      'required' => true,
      'default' => '',
      'label' => app::get('base')->_('模板名称'),
      'width' => 290,
      'unique' => true,
      'editable' => true,
      'in_list' => true,
      'default_in_list' => true,
      'searchtype' => 'has',
      'filtertype' => 'normal',
      'filterdefault' => true,
    ),
    'shortcut' =>
    array (
      'type' => 'bool',
      'default' => 'true',
      'label' => app::get('base')->_('是否启用'),
      'width' => 110,
      'editable' => true,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'disabled' =>
    array (
      'type' => 'bool',
      'default' => 'false',
      'editable' => false,
    ),
    'prt_tmpl_width' =>
    array (
      'type' => 'tinyint unsigned',
      'default' => 100,
      'label' => app::get('base')->_('宽度'),
      'required' => true,
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'prt_tmpl_height' =>
    array (
      'type' => 'tinyint unsigned',
      'default' => 100,
      'label' => app::get('base')->_('高度'),
      'required' => true,
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'prt_tmpl_offsetx' =>
    array (
      'type' => 'tinyint',
      'default' => 0,
      'label' => app::get('base')->_('打印偏移(左)mm'),
      'required' => true,
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'prt_tmpl_offsety' =>
    array (
      'type' => 'tinyint',
      'default' => 0,
      'label' => app::get('base')->_('打印偏移(右)mm'),
      'required' => true,
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'prt_tmpl_data' =>
    array (
      'type' => 'longtext',
      'editable' => false,
    ),
    'file_id' =>
    array (
      'type' => 'number',
      'label' => app::get('base')->_('文件ID'),
      'width' => 75,
    ),
  ),
  'comment' => '快递单模板',
  'engine' => 'innodb',
);