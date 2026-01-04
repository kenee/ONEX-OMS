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

$db['store_freeze_log'] = array (
    'columns'=>array(
        'log_id'=>array(
            'type' => 'int unsigned',
            'pkey' => true,
            'extra' => 'auto_increment',
            'editable' => false,
        ), 
        'product_id'=>array(
            'type' => 'table:products@ome',
            'required' => true,
            'default' => 0,
            'editable' => false,
            'in_list' => true,
            'label'=>'货品名称',
            'default_in_list' => true,
            'searchtype'=>'nequal',
            'filtertype' => 'normal',
            'filterdefault' => true,
        ),
        'num'=>array(
            'type' => 'int',
            'required' => true,
            'default' => 0,
            'editable' => false,
            'label'=>'变化数量',
            'comment'=>'变化数量',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'shop_id'=>array(
            'type' => 'table:shop@ome',
            'editable' => false,
            'label'=>'店铺名称',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'branch_id'=>array(
            'type' => 'table:branch@ome',
            'editable' => false,
            'in_list' => true,
            'label'=>'仓库名称',
            'default_in_list' => true,
        ),
        'original_id'=>array(
            'type'=>'int unsigned',
            'editable' => false,
            'comment'=>'原始单据ID',
            'label'=>'原始单据ID',
        ),
        'original_type'=>array(
            'type'=>'tinyint',
            'editable' => false,
            'comment'=>'原始单据类型',
            'label'=>'原始单据类型',
        ),
        'operator'=>array(
            'type'=>'tinyint',
            'required' => true,
            'editable' => false,
            'label'=>'操作符',
            'comment'=>'操作符,0减少，1增加',
        ),
        'status'=>array(
            'type' => array(
                'succ' => '成功',
                'fail' => '失败'
            ),
            'default' => 'succ',
            'editable' => false,
            'label'=>'状态',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'operate_time' => array (
              'type' => 'time',
              'editable' => false,
              'label'=>'操作时间',
              'comment'=>'操作时间',
              'in_list' => true,
              'default_in_list' => true,
        ),
        'memo' =>array(
              'type' => 'text',
              'editable' => false,
              'label'=>'备注',
              'comment'=>'备注',
        ),
        'addon' =>array(
              'type' => 'text',
              'editable' => false,
              'comment'=>'附加数据',
        ),
    ),
    'index'=>array(
        
        'ind_original_id'=>array(
            'columns'=>array(
                '0'=>'original_id',
            ),
        ),
    ),
    'comment' => '出入库日志表',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);