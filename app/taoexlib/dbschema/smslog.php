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

$db['smslog'] = array (
	'columns' => array(
		'id' => array(
			'type' => 'int unsigned',
			'required' => true,
			'pkey' => true,
			'extra' => 'auto_increment',
			'editable' => false,
		),
		'batchno' => array(
			'type' => 'int(11)',
			'required' => true,
			'comment' => '批号',
		),
		'deliverybn' => array(
			'type' => 'varchar(50)',
			'required' => true,
			'in_list'=>true,
			'label' => '发货单号',
			'default_in_list'=>true,
            'filtertype'=>true,
            'searchtype'=>true,
            'searchtype' => 'has',
		),
		'logino' => array(
			'type' => 'varchar(50)',
			'required' => true,
			'in_list'=>true,
			'label' => '快递单号',
			'default_in_list'=>true,
            'filtertype'=>true,
            'searchtype'=>true,
            'searchtype' => 'has',
		),
		'mobile' => array(
			'type' => 'varchar(50)',
			'label' => '手机号码',
			'required' => true,
			'in_list'=>true,
			'default_in_list'=>true,
            'filtertype'=>true,
            'searchtype'=>true,
            'searchtype' => 'has',
		),
		'content' => array(
			'type' => 'varchar(250)',
			'required' => true,
			'comment' => '短信内容',
		),
		'status' => array(
			'default' => '1',			
			'type' => array(
				'0' => '发送失败',
				'1' => '发送成功'
			),
			'required' => true,
			'label' => '发送状态',
			'in_list'=>true,
			'default_in_list'=>true,
            'filtertype'=>true,
            'searchtype'=>true,
            'searchtype' => 'has',
		),
		'msg' => array(
			'type' => 'text',
			'label' => '原因',
			'in_list'=>true,
			'default_in_list'=>true,
            'filtertype'=>true,
		),
		'sendtime' => array(
			'type' => 'time',
			'required' => true,
			'label' => '发送时间',
			'in_list'=>true,
			'default_in_list'=>true,
            'filtertype'=>true,
            'searchtype'=>true,
            'searchtype' => 'has',
		)
	),
	'comment' => '短信日志',
	'version' => '$Rev: 44513 $',
);
