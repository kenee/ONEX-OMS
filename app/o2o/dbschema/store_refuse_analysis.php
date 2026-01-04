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

$db['store_refuse_analysis'] = array(
    'columns' => array(
        'sra_id'      => array(
            'type'     => 'int unsigned',
            'required' => true,
            'width'    => 110,
            'hidden'   => true,
            'editable' => false,
            'pkey'     => true,
            'extra'    => 'auto_increment',
        ),
        'delivery_bn' => array(
            'type'     => 'varchar(32)',
            'required' => true,
            'label'    => '发货单单号',
            'editable' => false,
        ),
        'delivery_id' => array(
            'type'     => 'table:delivery@ome',
            'required' => true,
            'label'    => '发货单ID',
            'editable' => false,
        ),
        'store_bn'    => array(
            'type'     => 'varchar(20)',
            'required' => true,
            'label'    => '门店编码',
            'editable' => false,
        ),
        'store_name'  => array(
            'type'            => 'varchar(255)',
            'required'        => true,
            'label'           => '门店名称',
            'editable'        => false,
            'in_list'         => true,
            'default_in_list' => true,
        ),
        'reason_id'   => array(
            'type'     => 'varchar(255)',
            'required' => true,
            'label'    => '拒绝原因',
            'editable' => false,
        ),
        'memo'        => array(
            'type'     => 'text',
            'label'    => '备注',
            'editable' => false,
        ),
        'createtime'  => array(
            'type'     => 'time',
            'required' => true,
            'label'    => '创建时间',
            'width'    => 130,
            'editable' => false,
        ),
    ),
    'index'   => array(
        'ind_store_bn'   => array(
            'columns' => array(
                0 => 'store_bn',
            ),
        ),
        'ind_createtime' => array(
            'columns' => array(
                0 => 'createtime',
            ),
        ),
    ),
    'comment' => '门店拒单原因表',
    'engine'  => 'innodb',
);
