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

$db['delivery_extension']=array (
 'columns' =>
  array (
    'delivery_bn' =>
    array (
      'type' => 'varchar(32)',
      'required' => true,
      'label' => '发货单号',
      'comment' => '发货单号',
      'editable' => false,
    ),
    'original_delivery_bn' =>
    array (
      'type' => 'varchar(80)',
      'required' => true,
      'label' => '外部发货单号',
      'editable' => false,
        ),
    ),
     'index' =>
  array (
    'ind_delivery_bn' =>
    array (
      'columns' =>
      array (
        0 => 'delivery_bn',

      ),
    ),
   'ind_original_delivery_bn' =>
    array (
      'columns' =>
      array (
        0 => 'original_delivery_bn',

      ),
    ),
   
  ),
'comment' => '京东仓储发货单外部带好对于扩展表',
'engine' => 'innodb',
'version' => '$Rev: 41996 $',
);
?>