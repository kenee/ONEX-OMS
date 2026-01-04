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

$db['sms_sign'] = array (
	'columns' => array(
        's_id' => array(
            'type' => 'int unsigned',
            'required' => true,
            'label' => '签名编号',
            'pkey' => true,
            'extra' => 'auto_increment',
            'editable' => false,
        ),
        'name' => array(
            'type' => 'varchar(45)',
            'required' => true, 
            'label' => "名称",
            'default'  =>'0',
            'in_list'=>false,
            'default_in_list'=>false,
            'editable' => false,
        ),
        'extend_no' => array(  
            'type' => 'varchar(45)',
            'label' => '返回编号',
           
            'default'  =>'0',
            'in_list'=>true,
            'default_in_list'=>true,
        ),
       
    ),
    'comment' => '短信验签表',
    'version' => '$Rev: 44513 $',
);
