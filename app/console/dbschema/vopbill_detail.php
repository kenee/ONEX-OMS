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

$db['vopbill_detail']=array (
   'columns' => array(
        'id' => array(
            'type' => 'bigint unsigned',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'label' => '主键id',
            'editable' => false,
        ),
        'bill_id' => array(
            'type' => 'int unsigned',
            'label' => '唯品会账单',
          
            'editable' => false,
        ),
        'bill_number' => array(
            'type' => 'varchar(50)',
            'label' => '唯品会账单号',
            'in_list'         => true,
            'default_in_list' => true,
            'editable' => false,
            'width'           => 230,
            'searchtype' => 'nequal',
            'filtertype' => 'normal',
            'filterdefault' => true,
        ),
        
        'globalid' => array(
            'type' => 'bigint unsigned',
            'label' => '唯品会行ID',
            'in_list'         => true,
            'default_in_list' => true,
            'editable' => false,
        ),
        'barcode' => array(
            'type' => 'varchar(255)',
            'label' => '商品条形码',
            'comment' => 'itemNo',
            'in_list'         => true,
            'default_in_list' => true,
            'editable' => false,
        ),
       
        'quantity'=>array(
            'type' => 'money',
            'label' => '数量',
            'in_list'         => true,
            'default_in_list' => true,
            'editable' => false,
        ),
        'shop_id' => array(
            'type' => 'table:shop@ome',
            'label' => '店铺',
            'in_list'         => true,
            'default_in_list' => true,
            'editable' => false,
        ),
        'source'=>array(
            'type' => 'tinyint(1)',
            'label' => '数据来源',
            'in_list'         => true,
            'default_in_list' => true,
        ),
        'sourcetype'=>array(
            'type' => 'varchar(50)',
            'label'=>'源类型',
            'in_list'         => true,
            'default_in_list' => true,

        ),
      
        'amount' => array(
            'type' => 'decimal(20,8)',
            'label' => '金额',
          
            'in_list'         => true,
            'default_in_list' => true,
            'editable' => false,
        ),
        'targetamount'=>array(

            'type' => 'decimal(20,8)',
            'label' => '换汇金额',
          
            'in_list'         => true,
            'default_in_list' => true,
            'editable' => false,

        ),
        'expid'=>array(
            'type' => 'varchar(150)',
            'label'=>'外部系统费用单号',
            'in_list'         => true,
            'default_in_list' => true,
        ),
        'extordernum'=>array(
            'type' => 'varchar(150)',
            'label'=>'订单号',
            'in_list'         => true,
            'default_in_list' => true,

        ),

        'feeitem'=>array(
            'type' => 'varchar(50)',
            'label'=>'收费项目',
            'in_list'         => true,
            'default_in_list' => true,

        ),

        'addon' => array(
            'type' => 'longtext',
            'label' => '源数据',
            'in_list'         => false,
            'default_in_list' => false,
            'editable' => false,
        ),
    ),
    'index'   => array(
        'ind_globalid' => array('columns' => array('globalid'),'prefix'=>'unique'),
        'ind_bill_id' => array('columns' => array('bill_id')),   
        'ind_barcode' => array('columns' => array('barcode')),
        
    ),
    'comment' => '唯品会费用项明细',
    'engine' => 'innodb',
    'version' => '$Rev: 40654 $',
);