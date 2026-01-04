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


$db['task'] = array(
    'comment' => '活动任务信息',
    'columns' => array(
        'task_id' => array(
            'type'     => 'mediumint(8) unsigned',
            'required' => true,
            'pkey'     => true,
            'extra'    => 'auto_increment',
            'label'    => 'ID',
            'comment'  => ''
        ),
        
        'task_name' => array(
            'type'            => 'varchar(255)',
            'required'        => true,
            'label'           => app::get('inventorydepth')->_('活动名称'),
            'in_list'         => true,
            'default_in_list' => true,
            'comment'         => ''
        ),
        
        'operator' => array(
            'type'     => 'table:account@pam',
            'required' => false,
            'label'    => app::get('inventorydepth')->_('操作人'),
            'in_list'  => true,
            'comment'  => '',
        ),
        'update_time' => array(
            'type'     => 'last_modify',
            'required' => false,
            'label'    => app::get('inventorydepth')->_('最后更新时间'),
            'in_list'  => true,
            'comment'  => ''
        ),
        'operator_ip' => array(
            'type'     => 'ipaddr',
            'required' => false,
            'label'    => app::get('inventorydepth')->_('操作人IP'),
            'comment'  => ''
        ),
        'shop_id' =>
        array (
          'type' => 'table:shop@ome',
          'label' => '来源店铺',
          'width' => 75,
          'editable' => false,
          'in_list' => true,
          'filtertype' => 'normal',
          'filterdefault' => true,
        ),
        'start_time' => array(
            'type'            => 'time',
            'required'        => false,
            'label'           => app::get('inventorydepth')->_('开始时间'),
            'in_list'         => true,
            'default_in_list' => true,
            'filterdefault'   => true,
            'filtertype'      => 'normal',
            'comment'         => ''
        ),
        'end_time' => array(
            'type'            => 'time',
            'required'        => false,
            'label'           => app::get('inventorydepth')->_('结束时间'),
            'in_list'         => true,
            'default_in_list' => true,
            'filterdefault'   => true,
            'filtertype'      => 'normal',
            'comment'         => ''
        ),
        'disabled' => array(
            'type' => array(
                'true' => '开启',
                'false' => '关闭',
               
            ),
            'in_list'  => true,
            'default' => 'true',
            'label' => '启用状态',      
        ),
    ),
    
    'engine' => 'innodb',
    'version' => '$Rev: $'
);
