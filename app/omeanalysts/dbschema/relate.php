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

$db['relate']=array (
    'columns' => array (
        'relate_id' => array (
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'editable' => false,
        ),
        'relate_table' => array (
            'type' => 'varchar(50)',
            'editable' => false,
            'label' => app::get('omeanalysts')->_('关联表'),
        ),
        'relate_key' => array (
            'type' => 'varchar(50)',
            'editable' => false,
            'label' => app::get('omeanalysts')->_('关联表ID'),
        ),
        'disabled' => array (
            'type' => 'bool',
            'required' => true,
            'editable' => false,
            'default' => 'false',
        ),
    ),
    'index' =>
      array (
        'ind_relate_table' =>
        array (
            'columns' =>
            array (
              0 => 'relate_table',
            ),
        ),
        'ind_relate_key' =>
        array (
            'columns' =>
            array (
              0 => 'relate_key',
            ),
            'prefix' => 'unique',
        ),
      ),
    'comment' => '报表分析关联表',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);