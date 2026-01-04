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

$db['setting_shop']=array (
  'columns' => 
  array (
    'rid' => array (
        'type' => 'number',
        'required' => true,
        'pkey' => true,
        'extra' => 'auto_increment',
        'editable' => false,
        'label' => "关系ID",
    ),
    'sid' => array (
        'type' => 'table:setting@purchase',
        'required' => true,
        'editable' => false,
        'label' => "JIT配置ID",
    ),
    'shop_id' => array (
        'type' => 'table:shop@ome',
        'required' => true,
        'editable' => false,
        'label' => "应用到的店铺ID",
    ),
  ),
  'index' =>
    array (
            
  ),
  'comment' => 'JIT配置关联店铺表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);