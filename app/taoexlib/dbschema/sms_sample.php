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

$db['sms_sample'] = array (
    'columns' => array(
        'id' => array(
            'type' => 'int',
            'required' => true,
            'label' => '模板id',
            'pkey' => true,
            'extra' => 'auto_increment',
            'editable' => false,
        ),
        'sample_no' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => '模板编号',
            'in_list'=>true,
            'default_in_list'=>true,
        ),
        'title' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => '模板标题',
            'in_list'=>true,
            'default_in_list'=>true,
        ),
        'content' => array(
            'type' => 'varchar(200)',
            'required' => true,
            'label' => '模板内容',
            'in_list'=>true,
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
            'label' => '模板状态',
            'default_in_list'=>true,
        ),
        'send_type' => array(
            'type' => array(
                'delivery' => '发货',
                'o2opickup' => '门店自提',
                'o2oship' => '门店配送',
                'einvoice' => '电子发票',
                'express'=>'发货揽收',
                'received'=>'发货签收',
                'login'=>'登录',
            ),
            'required' => true,
            'in_list'=>true,
            'default_in_list'=>true,
            'label' => '发送节点',
        ),
    	'isapproved'=>array(
			'type' => 'bool',
			'required' => true,
			'default' => 'false',
			'editable' => false,
			'comment' => '审核成功即开启',
    	),
        'disabled' =>
        array (
          'type' => 'bool',
          'required' => true,
          'default' => 'false',
          'editable' => false,
        ),

        'approved' =>
            array (
              'type' =>array(
                '0'=>'等待审核',
                '1'=>'通过',
                '2'=>'拒绝',
              ),
              'default' => '0',
              'required' => true,
              'label' => '审核状态',
              'width' => 75,
              'hidden' => true,
              'editable' => false,
               'in_list'=>true,
            'default_in_list'=>true,
            ),
        'tplid' =>
            array (
                'type' => 'varchar(25)',
                'label' => '外部模板ID',

            ),
        
    ),
    'index' =>
    array (
        'ind_send_type' =>
        array (
            'columns' =>
            array (
                0 => 'send_type',
            ),
        ),
    ),
    'comment' => '短信模板',
    'version' => '$Rev: 44514 $',
);
