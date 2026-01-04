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


$db['task_skus'] = array(
    'comment' => '活动任务货品信息',
    'columns' => array(

        'sid' => array(
            'type'     => 'mediumint(8) unsigned',
            'required' => true,
            'pkey'     => true,
            'extra'    => 'auto_increment',
            'label'    => 'sid',
            'comment'  => ''
        ),
        'task_id' => array(
            'type'     => 'table:task@inventorydepth',
            'required' => true,
           
            
            'comment'  => '活动名称',
        ),
        'shop_id' => array(
            'type'     => 'table:shop@ome',
            'required' => true,
            'comment'  => app::get('inventorydepth')->_('店铺ID'),
            
            'label'           => app::get('inventorydepth')->_('前端店铺'),
            'in_list'  => true,
        ),
        'product_name' => array(
            'type'            => 'varchar(255)',
            'required'        => true,
            'label'           => '货号名称',
            'in_list'         => true,
            'default_in_list' => true,
            'comment'         => ''
        ),
        'product_bn' => array(
            'type' => 'varchar(30)',
            'required' => false,
            'label'    => '店铺货号',
            'in_list'  => true,
            'filterdefault'   => true,
            'filtertype'      => 'normal',
            'order'           => 60,
            'searchtype' => 'has', 
        ),
        'product_id' => 
        array (
          'type' => 'table:products@ome',
          'required' => true,
          'default' => 0,
          'editable' => false,
        ),
        
        'product_type' => array(
            'type'            => array(
                'product' => '普通',
                'pkg' => '捆绑',
                
            ),
            'default'         => 'product',
            'label'           => '商品类型',
            'in_list'  => true,
            'filterdefault' => true,
            'filtertype'      => true,
            'order' => 10
        ),
        
    ),
    'index' =>
    array (
        'ind_product_bn' =>
        array (
        'columns' =>
            array (
                0 => 'product_bn',
            ),
        ),
    ),
    'engine' => 'innodb',
    'version' => '$Rev: $'
);
