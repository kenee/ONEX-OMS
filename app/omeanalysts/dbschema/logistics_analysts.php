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

$db['logistics_analysts']=array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'label' => 'ID',
      'width' => 110,
      'hidden' => true,
      'editable' => false,
	  'filtertype' => 'normal',
    ),
    'branch_id' =>  
    array (
      'type' => 'number',
      'label' => '仓库',
      'width' => 75,
      'editable' => false,
    ),
    'logi_id' => array (
      'type' => 'number',
      'label' => '物流公司',
      'in_list' => true,
    ),
    'trace_date' => 
    array (
      'type' => 'varchar(15)',
      'required' => true,
    'label' => '记录日期',
      'editable' => false,
      'in_list' => true,
    ),
	'delivery_num' => 
    array (
      'type' => 'mediumint',
     'label' => '发货数量',
      'default' => 0,
      'editable' => false,
      'in_list' => true,
    ),
	'embrace_num' => 
    array (
      'type' => 'mediumint',
     'label' => '揽收数量',
      'default' => 0,
      'editable' => false,
      'in_list' => true,
    ),
    'sign_num' => 
    array (
      'type' => 'mediumint',
     'label' => '签收数量',
      'default' => 0,
      'editable' => false,
      'in_list' => true,
    ),
    'problem_num' => 
    array (
      'type' => 'mediumint',
     'label' => '问题件',
      'default' => 0,
      'editable' => false,
      'in_list' => true,
    ),
    'timeout_num' => 
    array (
      'type' => 'mediumint',
     'label' => '配送超时数量',
      'default' => 0,
      'editable' => false,
      'in_list' => true,
    ),
  ),
  'comment' => '仓储物流配送统计表',
  'index' =>
  array (
    'ind_trace_date' =>
    array (
        'columns' =>
        array (
          0 => 'trace_date',
        ),
    ),
    'ind_branch_id' =>
    array (
        'columns' =>
        array (
          0 => 'branch_id',
        ),
    ),
    'ind_logi_id' =>
    array(
      'columns' => 
      array(0=>'logi_id'),
     
    ),
    
  ),
  'engine' => 'innodb',
  'version' => '$Rev: 44513 $',
);
