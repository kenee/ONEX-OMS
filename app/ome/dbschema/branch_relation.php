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

$db['branch_relation']=array (
  'columns' =>
  array (
    'id' =>
    array (
      'type' => 'int unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
    ),
    'branch_id' =>
    array (
      'type' => 'number',
      'required' => true,
      'editable' => false,
      'comment' => '仓库ID',
    ),
    'relation_branch_bn' =>
    array (
      'type' => 'varchar(32)',
      'editable' => false,
      'comment' => '映射仓库编号',
    ),
    'type' =>
    array (
      'type' => array(
          '3pl' => '天猫3pl订单',
          'wmscd' => '架海金梁订单',
          'vopczc' => '唯品会仓中仓订单',
          'vopjitx' => '唯品会jitx订单',
          'luban' => '抖音区域仓编码',
          'zkh'   => '震坤行区域仓编码',
          'jdlvmi' => '京东云仓',
      ),
      'editable' => false,
      'comment' => '类型',
    ),
  ),
  'index' => array (
          'ind_branch_id' => array(
                  'columns' => array(
                          0 => 'branch_id',
                  ),
          ),
          'ind_relation_type' => array(
                  'columns' => array(
                          0 => 'relation_branch_bn',
                          1 => 'type',
                  ),
          ),
  ),
  'comment' => '平台仓库编码配置表',
  'engine' => 'innodb',
  'version' => '$Rev: 41996 $',
);