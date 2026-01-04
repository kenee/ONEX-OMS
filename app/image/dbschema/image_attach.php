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


$db['image_attach']=array (
  'columns' => 
  array (
    'attach_id' => array (
      'type' => 'number',
      'required' => true,
      'editable' => false,
      'pkey'=>true,
      'extra' => 'auto_increment',
    ),
    'target_id' => array (
      'type' => 'number',
      'required' => true,
      'default' => 0,
      'editable' => false,
      'comment' => '目标id',
    ),
    'target_type' => array (
      'type' => 'varchar(20)',
      'required' => true,
      'default' => 0,
      'editable' => false,
      'comment' => '目标类型',
    ),
    'image_id' => array (
      'type' => 'table:image',
      'required' => true,
      'default' => 0,
      'editable' => false,
      'comment' => '图片id',
    ),
    'last_modified'=>array(
      'label'=>app::get('image')->_('更新时间'),
      'type' => 'last_modify',
      'width'=>180,
      'required' => true,
      'default' => 0,
      'editable' => false,
      'in_list'=>true,
      'default_in_list'=>true,
    ),
  ),
  'index' =>
  array (
    'index_1' =>
    array (
      'columns' =>
      array (
        0 => 'target_id',
        1 => 'target_type',
      ),
    ),
  ),
  'comment' => '图片附件',
  'version' => '$Rev$',
);
