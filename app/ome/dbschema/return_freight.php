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

$db['return_freight'] = array(
    'columns' =>
    array(
        'return_id' =>
        array(
            'type' => 'int unsigned',
            'pkey' => true,
            'editable' => false,
            'comment' => '售后ID',
        ),
        'return_bn' =>
        array(
            'type' => 'varchar(32)',
            'default' => '',
            'label' => '退货记录流水号',
            'comment' => '退货记录流水号',
            'editable' => false,
        ),
        'amount' =>
        array(
            'type' => 'money',
            'default' => '0',
            'label' => '退货寄回运费',
            'editable' => false,
        ),
        'apply_desc' =>
        array(
            'type' => 'varchar(1000)',
            'default' => '',
            'label' => '申请描述',
            'editable' => false,
        ),
        'apply_images' =>
        array(
            'type' => 'text',
            'default' => '',
            'label' => '申请图片',
            'editable' => false,
        ),
        'handling_advice' =>
        array(
            'type' => [
                '1' => '同意',
                '2' => '拒绝',
            ],
            'default' => '1',
            'label' => '处理意见',
            'editable' => false,
        ),
        'reject_desc' =>
        array(
            'type' => 'varchar(1000)',
            'default' => '',
            'label' => '拒绝原因',
            'editable' => false,
        ),
        'reject_images' =>
        array(
            'type' => 'varchar(255)',
            'default' => '',
            'label' => '拒绝图片',
            'editable' => false,
        ),
    ),
    'index' =>
    array(
        'indx_return_bn' => ['columns' => ['return_bn']]
    ),
    'comment' => '退货寄回运费',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);
