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

$db['content']=array(
    'columns' =>
        array(
            'content_id' => array(
                'type' => 'int unsigned',
                'required' => true,
                'pkey' => true,
                'editable' => false,
                'label' => '发票内容ID',
                'extra' => 'auto_increment',
            ),
            'content_name' => array(
                'type' => 'varchar(100)',
                'label' => '发票内容名称',
                'in_list' => true,
                'default_in_list' => true,
                'width' => 120,
            ),
    ),
    'index' => array(
        'idx_content_name' => array(
            'columns'=>array(
                    0=>'content_name',
            ),
        ),
    ),
    'comment' => '发票内容表',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);