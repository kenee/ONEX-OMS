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

$db['delivery_bill']=array (
  'columns' => 
  array (
    'logi_id' => 
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'editable' => false,
   
    ),
    'delivery_id' => 
    array (
      'type' => 'int unsigned',
      'required' => true,
      'editable' => false,
      'label' => '发货单号',
      'comment' => '配送流水号',
      'width' =>140,
      'filtertype' => 'normal',
      'filterdefault' => true,
      'in_list' => true,
      'default_in_list' => true,
    ),

    'logi_no' => 
    array (
      'type' => 'varchar(50)',
      'label' => '物流单号',
      'comment' => '物流单号',
      'editable' => false,
      'width' =>110,
      'filtertype' => 'normal',
      'filterdefault' => true,
      'in_list' => true,
      'default_in_list' => true,
    ),
),
  'index' => 
  array (
    'index_logi_no' => 
    array (
      'columns' => 
      array (
        0 => 'logi_no',
      ),
    ),
  ),
  'comment' => '归档发货单多包裹表',
  'engine' => 'innodb',
  'version' => '$Rev: 41996 $',
);