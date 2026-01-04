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

$db['batch_detail_log']=array (
  'columns' => 
   array (
    'log_id' => 
    array (
      'type' => 'int(10)',
      'required' => true,
    ),
    'createtime' =>
    array (
      'type' => 'time',
      'label' => '发起同步时间',
      'width' => 130,
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
      'filtertype' => 'time',
      'filterdefault' => true,
    ),
    'logi_no' =>
    array (
      'type' => 'varchar(50)',
      'label' => '物流单号',
      'comment' => '物流单号',
      'editable' => false,
      'width' =>110,
      'in_list' => true,
      'default_in_list' => true,
	  'filtertype' => 'normal',
      'filterdefault' => true,
	  'searchtype' => 'has',
    ),
	'memo' =>
    array (
      'type' => 'text',
      'edtiable' => false,
    ),
	'status' =>
    array (
      'type' => 
        array (
          'success' => '成功',
          'fail' => '失败',
        ),
      'required' => true,
      'default' => 'fail',
      'editable' => false,
      'in_list' => false,
      'default_in_list' => false,
      'editable' => false,
      'filtertype' => 'yes',
      'filterdefault' => true,
      'label' => '状态',
      'width' => 60,
    ),
  ),
  'comment' => '批量发货日志',
  'engine' => 'innodb',
  'version' => '$Rev: 44513 $',
);
