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
 * 销售物料店铺冻结数据结构
 *
 * @author kamisama.xia@gmail.com 
 * @version 0.1
 */

$db['sales_material_shop_freeze']=array (
  'columns' =>
  array (
    'sm_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'width' => 260,
      'in_list' => true,
      'default_in_list' => true,
    ),
    'shop_id' => array(
        'type' => 'varchar(32)',
        'required' => true,
        'in_list' => true,
        'default_in_list' => true,
        'width' => 260,
    ),
    'shop_freeze' => array(
        'type' => 'number',
        'label' => '店铺销售物料库存冻结',
        'default' => 0,
        'in_list' => true,
        'default_in_list' => true,
    ),
  ),
  'comment' => '销售物料店铺冻结表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);
