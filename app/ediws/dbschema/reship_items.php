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

$db['reship_items']=array (
   'columns' => array(
        'items_id' => array(
            'type' => 'int unsigned',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'label' => '主键id',
            'editable' => false,
        ),
        'reship_id' => array(
            'type' => 'int unsigned',
            'label' => '退供单id',
            'in_list'         => true,
            'default_in_list' => true,
            'editable' => false,
        ),
        
        'skuid' =>
        array (
          'type' => 'varchar(100)',
          'label' => '商品编号',
          'width' => 150,
         
          'editable' => false,
        
        ),
        'skuname' =>array(
            'type'      => 'varchar(200)',
            'label'     => '商品名称',

        ),
        
      
        'actualnum'=> array(
            'type' => 'number',
            'label' => '实退数量',
            'in_list'         => true,
            'default_in_list' => true,
            'editable' => false,
        ),
       
       
    ),
    'index'   => array(
        'ind_skuid' => array('columns' => array('skuid')),
    ),
    'comment' => '退货单明细',
    'engine' => 'innodb',
    'version' => '$Rev: 40654 $',
);