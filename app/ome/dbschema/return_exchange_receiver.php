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

$db['return_exchange_receiver']=array (
  'columns' => 
  array (
   'return_id'=>array(
      'type' => 'table:return_product@ome',
      'required' => true,
      'pkey' => true,
      'editable' => false,
   ),
   'buyer_nick' =>
    array (
      'type' => 'varchar(255)',
      'editable' => false,
      'label' => '买家昵称',
      'in_list' => true,
      'default_in_list' => true,
    ),
   'buyer_name' =>
    array (
      'type' => 'varchar(255)',
      'editable' => false,
      'label' => '买家名称',
      'in_list' => true,
      'default_in_list' => true,
    ),
   'buyer_phone' =>
    array (
      'type' => 'varchar(255)',
      'editable' => false,
      'label' => '买家电话',
      'in_list' => true,
      'default_in_list' => true,
    ),
   'buyer_province' =>
    array (
      'type' => 'varchar(255)',
      'editable' => false,
      'label' => '买家省',
      'in_list' => true,
      'default_in_list' => true,
    ),
   'buyer_city' =>
    array (
      'type' => 'varchar(255)',
      'editable' => false,
      'label' => '买家市',
      'in_list' => true,
      'default_in_list' => true,
    ),
   'buyer_district' =>
    array (
      'type' => 'varchar(255)',
      'editable' => false,
      'label' => '买家区',
      'in_list' => true,
      'default_in_list' => true,
    ),
   'buyer_town' =>
    array (
      'type' => 'varchar(255)',
      'editable' => false,
      'label' => '买家镇',
      'in_list' => true,
      'default_in_list' => true,
    ),
   'buyer_address' =>
    array (
      'type' => 'varchar(255)',
      'editable' => false,
      'label' => '买家地址',
      'in_list' => true,
      'default_in_list' => true,
    ),
   'encrypt_source_data' =>
    array (
      'type' => 'text',
      'editable' => false,
      'label' => '加密数据',
      'in_list' => true,
      'default_in_list' => true,
    ),
  ),
  'index' => array (
        /*'in_reship_id' => array (
            'columns' => array (
                    0 => 'reship_id',
            ),
        ),*/
  ),
  'engine' => 'innodb',
  'version' => '$Rev:  $',
  'comment'=>'换货地址表',
);