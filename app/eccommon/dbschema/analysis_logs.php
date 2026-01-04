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


$db['analysis_logs']=array (
  'columns' =>
  array (
    'id' =>
    array (
      'type' => 'bigint unsigned',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'editable' => false,
    ),
    'analysis_id' =>
    array (
      'type' => 'number',
      'required' => true,
      'comment' => '报表ID',
    ),
    'type' =>
    array (
      'type' => 'number',
      'required' => true,
      'label' => '类型',
      'default' => 0,
    ),
    'target' =>
    array (
      'type' => 'number',
      'required' => true,
      'label' => '指标',
      'default' => 0,
    ),
    'flag' =>
    array (
      'type' => 'number',
      'required' => true,
      'label' => '标识',
      'default' => 0,
    ),
    'value' =>
    array (
      'type' => 'float',
      'required' => true,
      'label' => '数据',
      'default' => 0,
    ),
    'time' =>
    array (
      'type' => 'time',
      'required' => true,
      'label' => '时间',
    ),
  ),
  'index' =>
      array (
        'ind_analysis_id' =>
        array (
          'columns' =>
          array (
            0 => 'analysis_id',
          ),
        ),
        'ind_type' =>
        array (
          'columns' =>
          array (
            0 => 'type',
          ),
        ),
        'ind_target' =>
        array (
          'columns' =>
          array (
            0 => 'target',
          ),
        ),
        'ind_time' =>
        array (
          'columns' =>
          array (
            0 => 'time',
          ),
        ),
    ),
  'comment' => '电商商务通用应用分析记录',
  'ignore_cache' => true,
);

