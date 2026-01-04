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

$db['actual_object']=array (
  'columns' =>
  array (
    'obj_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'editable' => false,
      'extra' => 'auto_increment',
    ),
    'eid'=>array(
      'type' => 'table:estimate@logisticsaccounts',
      'required' => true,
      'default' => 0,
      'comment' => '物流对账ID',
    ),
    'aid'=>array(
    'type' =>'table:actual@logisticsaccounts',
    'required'=>true,
    'default'=>0,
    'comment'=>'物流账单主键',
    ),
    'status'=>array(
    'type'=>array(
      0=>'否',
    1=>'是',
    ),
    'default'=>'0',
    'label'=>'是否异常'
  ),
    'memo'=>array(
    'type'=>'text',
    'label'=>'备注'
   ),
),
'index' =>
  array (
    'uni_indx' =>
    array (
      'columns' =>
      array (
       0 => 'eid',
       1 => 'aid',
      ),
      'prefix' => 'UNIQUE',
    ),
  ),
  'comment' => '物流账单对象',
  'engine' => 'innodb',
  'version' => '$Rev: 41996 $',
);