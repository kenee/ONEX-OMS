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

$db['sale_products']=array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'label' => 'ID',
    ),
	'product_id' =>  
    array (
      'type' => 'table:products@ome',
      'label' => '货号',
    ),
    'branch_id' =>  
    array (
      'type' => 'table:branch@ome',
      'label' => '仓库',
    ),
    'sales_nums' =>
    array (
      'type' => 'number',
      'editable' => false,
	  'label' => '销量',
    ),
	'sales_price' =>
    array (
      'type' => 'money',
      'editable' => false,
	  'label' => '销售单价',
    ),
	'sales_time' =>
    array (
      'type' => 'time',
      'label' => '销售时间',
    ),
  ),
  'comment' => '已销售产品',
  'index' => 
  array (
    
    'ind_sales_time' => 
    array (
      'columns' => 
      array (
        0 => 'sales_time',
      ),
    ),
  ),
  'engine' => 'innodb',
  'version' => '$Rev: 44513 $',
);
