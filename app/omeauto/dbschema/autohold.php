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

$db['autohold']=array (
  'columns' => 
  array (
    'tid' => 
    array (
      'type' => 'number',
      'required' => true,
      'label' => '规则ID',
      'pkey' => true,
    ),
    'hold' => 
    array (
      'type' => array('all'=>'全部','part'=>'部分'),
      'required' => true,
      'label' => 'hold单',
      'default' => 'all',
    ),
   'hours'=>array(
      'type' => 'int',
      'label' => 'hold单小时数',
      'default'=>0,
    ),
  ),
  
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);