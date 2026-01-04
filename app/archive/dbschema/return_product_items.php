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

$db['return_product_items']=array (
  'columns' => 
  array (
    'item_id' => 
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
      'label'=>'明细ID',
      'comment'=>'明细ID',
    ),
    'return_id' => 
    array (
      'type' => 'int unsigned',
      'required' => true,
      'editable' => false,
      'label'=>'售后ID',
      'comment'=>'售后ID',      
    ),
    'product_id' => 
    array (
      'type' => 'int unsigned',
      'required' => true,
      'editable' => false,
      'label'=>'货品ID',
      'comment'=>'货品ID',       
    ),
    'bn' => 
    array (
      'type' => 'varchar(50)',
      'editable' => false,
      'label'=>'货品bn',
      'comment'=>'货品bn',      
    ),
    'name' => 
    array (
      'type' => 'varchar(200)',
      'editable' => false,
      'label'=>'货品名称',
      'comment'=>'货品名称',      
    ),
    'branch_id' => 
    array (
      'type' => 'number',
      'editable' => false,
      'label'=>'仓库ID',
      'comment'=>'仓库ID',         
    ),
    'num' => 
    array (
      'type' => 'number',
      'editable' => false,
      'label'=>'数量',
      'comment'=>'数量',      
    ),
    'price' => 
    array (
      'type' => 'money',
      'default' => '0',
   
      'editable' => false,
    ),
   
    
  ), 
  'engine' => 'innodb',
  'version' => '$Rev:  $',
  'comment'=>'售后申请单据明细',
);