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


$db['regulation'] = array(
    'comment' => '所有的规则信息',
    'columns' => array(
        'regulation_id' => array(
            'type'     => 'mediumint(8) unsigned',
            'required' => true,
            'pkey'     => true,
            'extra'    => 'auto_increment',
            'label'    => 'ID',
            'comment'  => ''
        ),
        'condition' => array(
            'type' => array(
                'frame' => '商品上下架', 'stock' => '库存更新'
            ),
            'required'        => true,
            'label'           => app::get('inventorydepth')->_('规则类型'),
            'in_list'         => true,
            'default_in_list' => true,
            'filterdefault'   => true,
            'filtertype'      => 'normal',
            'comment'         => ''
        ),
        'bn' => array(
            'type'            => 'bn',
            'required'        => true,
            'label'           => app::get('inventorydepth')->_('规则编码'),
            'in_list'         => true,
            'default_in_list' => true,
            'comment'         => ''
        ),
        'heading' => array(
            'type'            => 'varchar(200)',
            'required'        => true,
            'label'           => app::get('inventorydepth')->_('规则名称'),
            'is_title'        => true,
            'in_list'         => true,
            'default_in_list' => true,
            'searchtype'      => 'has',
            'comment'         => '',
        ),
        'using' => array(
            'type'            => 'bool',
            'required'        => false,
            'default'         => 'false',
            'label'           => app::get('inventorydepth')->_('启用状态'),
            'in_list'         => true,
            'default_in_list' => true,
            'filterdefault'   => true,
            'filtertype'      => 'normal',
            'comment'         => ''
        ),
        'remark' => array(
            'type'     => 'html',
            'required' => false,
            'label'    => app::get('inventorydepth')->_('备注'),
            'comment'  => ''
        ),
        'content' => array(
            'type'     => 'serialize',
            'required' => true,
            'label'    => app::get('inventorydepth')->_('规则内容'),
            'comment'  => '数组存储规则内容'
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
        'description' => array(
            'type'    => 'longtext', 
            'default' => '', 
        ),
        'type' => array(
            'type' => array(
                0 => app::get('inventorydepth')->_('全局级规则'),
                1 => app::get('inventorydepth')->_('店铺级规则'),
                2 => app::get('inventorydepth')->_('商品级规则'),
                3 => '门店级规则',
            ),
            'label' => app::get('inventorydepth')->_('规则类型'),
            'default' => '2',
        ),
    ),
    'index' => array(
        'idx_bn' => array(
            'columns' => array('bn')
        ),
        'idx_heading' => array(
            'columns' =>array('heading')
        )
    ),
    'engine' => 'innodb',
    'version' => '$Rev: $'
);
