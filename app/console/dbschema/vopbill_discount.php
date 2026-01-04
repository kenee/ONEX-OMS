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

$db['vopbill_discount']=array (
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
        'bill_amount_id' => array(
            'type' => 'bigint unsigned',
            'label' => '唯品会账单',
            'in_list'         => true,
            'default_in_list' => true,
            'editable' => false,
        ),
        'origin_id' => array(
            'type' => 'bigint unsigned',
            'label' => '唯品会明细ID',
            'in_list'         => true,
            'default_in_list' => true,
            'editable' => false,
        ),
        'ordernum'=>array(
            'type' => 'varchar(80)',
            'label' => '订单号',
            'comment' => 'itemNo',
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
        'product_name' => array(
            'type' => 'varchar(255)',
            'label' => '商品名称',
            'comment' => 'itemDescription',
            'in_list'         => true,
            'default_in_list' => true,
            'editable' => false,
        ),
        'detail_line_type' => array(
            'type' => 'varchar(255)',
            'label' => '行类型',
            'in_list'         => true,
            'default_in_list' => true,
            'editable' => false,
            'searchtype' => 'nequal',
            'filtertype' => 'normal',
            'filterdefault' => true,
        ),
        'detail_line_name' => array(
            'type' => 'varchar(255)',
            'label' => '行类型名称',
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
        'datasign' => array(
            'type' => 'tinyint(2)',
            'label' => '数据标识',
            'in_list'         => true,
            'default_in_list' => true,
            'editable' => false,
        ),
        'totalbillamount' => array(
            'type' => 'decimal(20,8)',
            'label' => '单价',
            'comment' => 'billTaxPrice',
            'in_list'         => true,
            'default_in_list' => true,
            'editable' => false,
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
        'ind_origin_id' => array('columns' => array('origin_id'),'prefix'=>'unique'),
        'ind_bill_id' => array('columns' => array('bill_id')),
        'ind_bill_amount_id' => array('columns' => array('bill_amount_id')),
        'ind_barcode' => array('columns' => array('barcode')),
        'ind_detail_line_type' => array('columns' => array('detail_line_type')),
        'ind_detail_line_name' => array('columns' => array('detail_line_name')),
    ),
    'comment' => '唯品会账单满减明细',
    'engine' => 'innodb',
    'version' => '$Rev: 40654 $',
);