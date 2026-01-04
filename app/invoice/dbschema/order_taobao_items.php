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

$db['order_taobao_items']=array(
    'columns' =>
        array(
            'otbiid' => array(
                'type' => 'int(11)',
                'pkey' => true,
                'extra' => 'auto_increment',
                'required' => true,
                'label' => '主键ID',
            ),
            
            'otbid' => array(
                'type' => 'table:order_taobao@invoice',
                'default' => '0',
                'required' => true,
                'label' => '开票申请原始ID',
            ),
            'item_name' => array(
                'type' => 'varchar(200)',
                'label' => '商品名称',
            ),
            'amount' => array (
                'type' => 'money',
                'default' => '0',
                'label' => '价税合计',
            ),
            'row_type' => array(
                'type' => array(
                    0=>'正常行',
                    1=>'折扣行',
                    2=>'被折扣行',
                ),
                'label' => '发票行性质',
                'default' => '0',
            ),
            'specification' => array(
                'type' => 'varchar(100)',
                'label' => '规格型号',
            ),
            'sum_price' => array(
                'type' => 'money',
                'default' => '0',
                'required' => true,
                'label' => '不含税总金额',
            ),
            'tax' => array(
                'type' => 'money',
                'default' => '0',
                'required' => true,
                'label' => '税额',
            ),
            'price' => array(
                'type' => 'money',
                'default' => '0',
                'required' => true,
                'label' => '单价',
            ),
            'quantity' => array (
                'type' => 'number',
                'default' => 1,
                'required' => true,
            ),
            'tax_rate' => array(
                'type' => 'decimal(3,2)',
                'default' => '0.00',
                'required' => true,
                'label' => '税率',
            ),
            'unit' => array(
                'type' => 'varchar(20)',
                'label' => '单位',
            ),
    ),
    'index' => array(
        
    ),
    'comment' => '淘系原始开票明细信息',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);