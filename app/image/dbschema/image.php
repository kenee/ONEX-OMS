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


$db['image']=array (
  'columns' => 
  array (
    'image_id' => 
    array (
      'type' => 'char(32)',
      'label'=>app::get('image')->_('图片Id'),
      'required' => true,
      'pkey' => true,
      'width'=>250,
      'in_list'=>true,
      'default_in_list'=>false,
    ),
    'storage'=>array(
      'label'=>app::get('image')->_('存储引擎'),
      'type' => 'varchar(50)',
      'default' => 'filesystem',
      'required' => true,
      'in_list'=>true,
      'width'=>100,
      'default_in_list'=>false,
    ),
    'image_name'=>array(
      'label'=>app::get('image')->_('图片名称'),
      'type' => 'varchar(50)',
      'required' => false,
      'width'=>100,
      'default_in_list'=>true,
    ),
    'ident'=>array(
      'type' => 'varchar(200)',
      'required' => true,
      'comment' => '标识符',
    ),
    'url'=>array(
      'label'=>app::get('image')->_('网址'),
      'type'=>'varchar(500)',
      'required' => true,
      'width'=>300,
      'in_list'=>false,
      'comment' => '网址',
    ),
    'l_ident'=>array(
      'type' => 'varchar(200)',
      'comment' => '大图标识符',
    ),
    'l_url'=>array(
      'type' => 'varchar(500)',
      'comment' => '大图url',
    ),
    'm_ident'=>array(
      'type' => 'varchar(200)',
      'comment' => '中图标识符',
    ),
    'm_url'=>array(
      'type' => 'varchar(500)',
      'comment' => '中图url',
    ),
    's_ident'=>array(
      'type' => 'varchar(200)',
      'comment' => '小图标识符',
    ),
    's_url'=>array(
      'type' => 'varchar(500)',
      'comment' => '小图url',
    ),
    'width'=>array(
       'label'=>app::get('image')->_('宽度'),
      'type' => 'number',
      'in_list'=>true,
      'default_in_list'=>false,
    ),
    'height'=>array(
      'label'=>app::get('image')->_('高度'),
      'type' => 'number',
      'in_list'=>true,
      'default_in_list'=>false,
    ),
    'watermark'=>array(
        'type'=>'bool',
        'default' => 'false',
        'label'=>app::get('image')->_('有水印'),
        'in_list'=>true,
        'default_in_list'=>true,
    ),
    'last_modified' => array (
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
  'comment' => '图片库表',
  'engine' => 'innodb',
  'version' => '$Rev: 40912 $',
);
