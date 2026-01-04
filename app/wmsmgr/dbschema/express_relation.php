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

$db['express_relation']=array (
  'columns' =>
  array (
    'wms_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'editable' => false,
      //'extra' => 'auto_increment',
    ),
    'logi_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'editable' => false,
      //'extra' => 'auto_increment',
    ),
    'sys_express_bn' =>
    array (
      'type' => 'varchar(32)',
      'required' => true,
      'editable' => false,
      'label' => '物流公司编号',
      'comment' => '物流公司编号',
      'width' =>140,
    ),
    'wms_express_bn' =>
    array (
      'type' => 'varchar(32)',
      'editable' => false,
      'label' => 'WMS物流公司编号',
      'comment' => 'WMS物流公司编号',
      'width' =>140,
    ),
  ),
  'index' =>
  array (
    'index_wms_id_sys_express_bn' =>
    array (
      'columns' =>
      array (
        0 => 'wms_id',
        1 => 'sys_express_bn',
      ),
    ),
    
  ),
  'comment' => '物流公司关联表',
  'engine' => 'innodb',
  'version' => '$Rev: 41996 $',
);