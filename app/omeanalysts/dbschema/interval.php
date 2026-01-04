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

$db['interval']=array (
    'columns' => array (
        'interval_id' => array (
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'editable' => false,
        ),
        'from' => array (
            'type' => 'int unsigned',
            'label' => '起始价格',
            'in_list' => true,
        ),
        'to' => array (
            'type' => 'int unsigned',
            'label' => '截止价格',
            'in_list' => true,
        ),
      ),
    'comment' => '价格区间',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);