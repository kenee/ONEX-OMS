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

$db['branch_product']=array (
  'columns' =>
  array (
    'id' =>
     array ( 
      'type' => 'number',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
    ),
    'branch_id' =>
    array (
      'type' => 'table:branch@ome',
      'required' => true,
      'editable' => false,
    ),
    'bm_id' =>
    array (
      'type' => 'table:basic_material@material',
      'required' => true,
      'editable' => false,
    ),
    'is_ctrl_store' =>
    array (
      'type' => 'tinyint(1)',
      'default' => 2,
      'label' => '库存',
      'width' => 80,
      'required' => false,
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
      'order' => 70,
    ),
    'status' => 
    array(
      'type' => 'tinyint(1)',
      'label' => '销售状态',
      'width' => 80,
      'default' => 1,
      'in_list' => true,
      'default_in_list' => true,
      'order' => 80,
    ),
    'is_bind' =>
    array (
      'type' => 'tinyint(1)',
      'default' => 1,
      'label' => '绑定状态',
      'required' => false,
      'editable' => false,
      'order' => 90,
    ),
  ),
  'index' => array(
        'ind_branch_id_bm_id' =>
        array (
            'columns' =>
            array (
                0 => 'branch_id',
                1 => 'bm_id',
            ),
            'prefix' => 'unique',
        ),
  ),
  'comment' => '门店供货关系表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);