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

$db['abnormal_cause'] = array( 
    'columns' => array(
        'ac_id' => array (
            'type' => 'number',
            'pkey' => true,
            'editable' => false,
            'extra' => 'auto_increment',
        ),
        'abnormal_cause' => array(
            'type' => 'varchar(300)',
            'editable' => false,
            'in_list' => true,
            'default_in_list' => true,
            'label' => '异常原因',
            'required' => true,
        ),
    ),
    'index' => array(),
    'comment' => '异常原因信息',
    'engine' => 'innodb',
    'version' => '$Rev: 44513 $',
);
