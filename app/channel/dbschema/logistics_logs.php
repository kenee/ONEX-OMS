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

#操作日志
$db['logistics_logs']=array (
    'columns' => 
    array (
        'id' =>
        array(
            'type' => 'int unsigned',
            'required' => true,
            'pkey' => true,
            'editable' => false,
            'extra' => 'auto_increment',
        ),
        'op_user' => 
        array(
            'type' => 'varchar(50)',
            'label'=>'操作人',
        ),
        'exrecommend_souce' => 
        array(
            'type' => 'varchar(20)',
            'label'=>'来源',
            'default' => 'hqepay',#默认是快递鸟来源,以兼容
        ),
        #日志操作类型
       'op_type' =>
        array (
        	'type' =>
        	array (
        		'1' => '同步运费模板',
        		'2' => '智选物流策略设置',
        		'3'=>  '运费模板变动'
        	),
        ),
        'op_content' =>
        array (
        		'type' => 'text',
        		'label'=>'操作内容',
        ),
      'status' => 
        array(
            'type' => 'varchar(10)',
            'label'=>'状态',
            'default' => '',
        ),
        'create_time' => 
        array(
            'type' => 'time',
            'label'=>'操作时间',
        ),
    ),
    'index' =>
    array (
    		'ind_op_type' =>
    		array (
    				'columns' =>
    				array (
    						0 => 'op_type',
    				),
    		),
    ),
    'comment' => '日志表',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);