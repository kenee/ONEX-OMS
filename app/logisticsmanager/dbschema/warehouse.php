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

$db['warehouse']=array (
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
    'warehouse_name' => 
    array (
      'type' => 'varchar(25)',
      
      'editable' => false,
      'label' => '区域仓名称',
      'width' => 130,
      'searchtype' => 'has',
      'filtertype' => 'normal',
      'filterdefault' => true,
      'in_list' => true,
      'default_in_list' => true,
      'order' => 1,
    ),
    
    'branch_id' =>
    array (
      'type' => 'table:branch@ome',
      'editable' => false,
      'label' => '系统仓库名称',
      'width' => 110,
      'filtertype' => 'normal',
      'filterdefault' => true,
      'in_list' => true,
      'order' => 2,
    ),
    'branch_bn'=>array(

      'type' => 'varchar(32)',
    
      'in_list' => true,
      'default_in_list' => true,
      'label' => '系统仓库ID',

    ),
    'region_ids'=>array(
      'type' => 'text',
       'default' => '0',
      'editable' => false,
      'label' => '覆盖区域id',
      'width' => 130,
     'order' => 10,
    ),
     'region_names'=>array(
      'type' => 'text',
      'default' => '0',
      'editable' => false,
      'label' => '覆盖区域',
      'width' => 130,
      'in_list' => false,
      'default_in_list' => false,
      'order' => 3,
    ),
   'warn_num' => 
    array (
      'type' => 'number',
      'default' => 0,
      'required' => true,
      'editable' => false,
      'label'=>'库存预警值',
      'in_list' => true,
      'default_in_list' => true,
    ),
    'operator'       => array(
      'type'            => 'varchar(30)',
      'comment'         => '创建人',
      'default_in_list' => true,
      'in_list'         => true,
      'label'           => '创建人',
    ),
     'create_time' =>
    array (
      'type' => 'time',
     'comment' => '创建时间',
      'label' => '创建时间',
      'width' => '130',
      'in_list' => true,
     
    ),
    'last_modified'      => array(
      'label'    => '最后更新时间',
      'type'     => 'last_modify',
      'width'    => 130,
      'editable' => false,
      'in_list'  => true,
    ),
    'one_level_region_names'=>array(
        'type' => 'varchar(255)',
        'default' => '',
        'editable' => false,
        'label' => '一级地址覆盖区域',
        'width' => 130,
        'in_list' => false,
        'default_in_list' => false,
        'order' => 3,
    ),
    'b_type' => array(
      'type' => 'tinyint(1)',
      'editable' => false,
      'label' => '业务类型',
      'default' => 1,
      'comment' => '1=仓库，2=门店，同ome_branch的b_type',
      'in_list' => true,
      'default_in_list' => true,
      'width' => 80,
      'order' => 4,
    ),
  ),
  
  'comment' => '区域仓表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);