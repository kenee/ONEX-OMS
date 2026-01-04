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

$db['autobranchget']=array (
  'columns' => 
  array (
    'tid' => 
    array (
      'type' => 'number',
      'required' => true,
      'label' => '规则ID',
      'pkey' => true,
    ),
    'classify' => 
    array (
      'type' => 'varchar(255)',
      'required' => true,
      'label' => '分类：就近，成本',
      'pkey' => true,
    ),
   'weight'=>array(
      'type' => 'tinyint',
      'label' => '权重',
      'default'=>0,
    ),
  ),
  
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);