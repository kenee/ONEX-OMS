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


$db['auth'] = array(
    'columns'=>array(
        'auth_id'=>array('type'=>'number','pkey'=>true,'extra' => 'auto_increment',),
        'account_id'=>array('type'=>'table:account','comment'=>'账户id'),
        'module_uid'=>array('type'=>'varchar(200)','comment'=>'模块id'),
        'module'=>array('type'=>'varchar(50)','comment'=>'模块'),
        'data'=>array('type'=>'text','comment'=>'数据'),
    ),
  'index' => array (
    'account_id' => array ('columns' => array ('module','account_id'),'prefix' => 'UNIQUE'),
    'module_uid' => array ('columns' => array ('module','module_uid'),'prefix' => 'UNIQUE'),
  ),
  'comment' => '授权数据表',
);
