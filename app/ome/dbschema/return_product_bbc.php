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

$db['return_product_bbc']=array (
  'columns' => 
  array (
    'shop_id' =>
    array (
      'type' => 'table:shop@ome',
      'label' => '来源店铺',
     
  
      'width' => 75,
      'editable' => false,
      ),
    
    'return_bn' =>
    array (
      'type' => 'varchar(32)',
   
      'label' => '退货记录流水号',
      'comment' => '退货记录流水号',
      'editable' => false,
     
    ),
   'return_type' =>
    array (
      'type' =>
      array (
        'return' => '退货',
        'change' => '换货',
		'refund' => '退款',
      ),
      'default' => 'return',
      'required' => true,
      'comment' => '退换货状态',
      'editable' => false,
      'label' => '退换货状态',
      'width' =>65,
   
    ),
    
 ),
  'index' =>
  array (
    'ind_return_apply_bn_shop' =>
    array (
        'columns' =>
        array (
          0 => 'return_bn',
          1 => 'shop_id',
        ),
        'prefix' => 'unique',
    ),
    
  ),
  'comment' => '售后申请BBC附加表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);