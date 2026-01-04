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

$db['sms_bind'] = array (
	'columns' => array(
        'bind_id' => array(
            'type' => 'int unsigned',
            'required' => true,
            'label' => '绑定编号',
            'pkey' => true,
            'extra' => 'auto_increment',
            'editable' => false,
        ),
        'tid' => array(
            'type' => 'int(11)',
            'required' => true, 
            'label' => "规则名称",
            'default'  =>'0',
            'in_list'=>false,
            'default_in_list'=>false,
            'editable' => false,
        ),
        'id' => array(  
            'type' => 'table:sms_sample@taoexlib',
            'label' => '模板编号',
            'required' => true,
            'default'  =>'0',
            'in_list'=>true,
            'default_in_list'=>true,
        ),
        'is_default' => array(
            'type' => array(
                '0' => '否',
                '1' => '是',
            ),
            'required' => true,
            'default' => '0',
            'in_list'=>true,
            'label' => '是否默认',
            'default_in_list'=>true,
        ),
        'is_send' => array(
            'type' => array(
                '0' => '不发送',
                '1' => '发送',
            ),
            'required' => true,
            'default' => '1',
            'in_list'=>true,
            'label' => '是否发送',
            'default_in_list'=>true,
        ),
        'status' => array(
            'type' => array(
                '0' => '关闭',
                '1' => '开启',
            ),
            'required' => true,
            'default' => '1',
            'in_list'=>true,
            'label' => '绑定状态',
            'default_in_list'=>true,
        ),
    ),
    'comment' => '发送设置',
    'version' => '$Rev: 44513 $',
);
