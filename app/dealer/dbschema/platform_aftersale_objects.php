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

$db['platform_aftersale_objects'] = array(
    'columns' => array(
        'plat_aftersale_obj_id' => array(
            'type' => 'int unsigned',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'label' => 'ID',
        ),
         'plat_aftersale_id'=> array(
            'type'     => 'int unsigned',
            'required' => true,
            'label'    => '平台售后单号id',
        ),
       
        'oid'             => array(
            'type'     => 'varchar(50)',
            'default'  => 0,
            'editable' => false,
            'label'    => '子订单号',
        ),
        'goods_id' => array(
            'type' => 'int unsigned',
           
            'default'  => 0,
            'editable' => false,
            'label' => '销售物料ID',
            'comment' => '销售物料ID,关联material_sales_material.sm_id'
        ),
        'num'             => array(
            'type'     => 'number',
            'label'    => '数量',
        ),
        'price'             => array(
             'type'     => 'money',
             'label'    => '单价',
        ),

        'outer_id'             => array(
            'type'     => 'varchar(50)',
            'label'    => '货号',
        ),
      
    ),
    'index' => array (
        
        'ind_oid' => array(
            'columns' => array(
                'oid',
            ),
        ),
       
    ),
    'comment' => 'platform_aftersale_objects',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);