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

$db['branch_relation']=array (
  'columns' =>
  array (
    'wms_id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      //'pkey' => true,
      'editable' => false,
      //'extra' => 'auto_increment',
    ),
    'sys_branch_bn' =>
    array (
      'type' => 'varchar(32)',
      'required' => true,
      'editable' => false,
      'label' => '仓库编号',
      'comment' => '仓库编号',
      'width' =>140,
    ),
    'wms_branch_bn' =>
    array (
      'type' => 'varchar(32)',
      'editable' => false,
      'label' => 'WMS仓库编号',
      'comment' => 'WMS仓库编号',
      'width' =>140,
    ),
    'negative' =>
    array (
      'type' => 'mediumint',
      'editable' => false,
      'label' => '权重',
      'width' =>140,
    ),
  ),
  'index' =>
  array (
    'index_wms_id_sys_branch_bn' =>
    array (
      'columns' =>
      array (
        0 => 'wms_id',
        1 => 'sys_branch_bn',
      ),
    ),
    
  ),
  'comment' => '第三方仓储仓库关联关系表',
  'engine' => 'innodb',
  'version' => '$Rev: 41996 $',
);