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

$db['check_log']=array (
  'columns' =>
  array (
  'l_id' =>
    array (
        'type' => 'number',
        'required' => true,
        'editable' => false,
        'pkey' => true,
        'label' => 'ID',
        'extra' => 'auto_increment',
    ),
    'delivery_id' =>
    array (
      'type' => 'table:delivery@ome',
      'required' => true,
      'editable' => false,
    ),
    'old_op_id' =>
    array (
      'type' => 'table:account@pam',
      'required' => true,
      'editable' => false,
    ),
    'new_op_id' =>
    array (
      'type' => 'table:account@pam',
      'required' => true,
      'editable' => false,
    ),
	'addtime' =>
    array (
        'type' => 'time',
        'required' => true,
        'editable' => false,
    ),
  ),
  'comment' => '拣货检验日志表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);