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


$db['formula'] = array(
    'comment' => '所有的公式信息，包括调整价格、调整库存等等..',
    'columns' => array(
        'formula_id' => array(
            'type' => 'mediumint(8) unsigned',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'label' => 'ID',
            'comment' => ''
        ),
        'style' => array(
            'type' => array(
                'fund' => '价格调整', 'stock' => '库存调整'
            ),
            'required' => true,
            'label' => app::get('inventorydepth')->_('属性类别'),
            'comment' => ''
        ),
        /*
        'bn' => array(
            'type' => 'bn',
            'required' => false,
            'label' => app::get('inventorydepth')->_('公式编码'),
            'comment' => ''
        ),*/
        'heading' => array(
            'type' => 'varchar(200)',
            'required' => true,
            'label' => app::get('inventorydepth')->_('公式名称'),
            'is_title' => true,
            'in_list' => true,
            'default_in_list' => true,
            'searchtype' => 'has',
            'comment' => '',
        ),
        'content' => array(
            'type' => 'serialize',
            'required' => true,
            'label' => app::get('inventorydepth')->_('公式内容'),
            'comment' => '数组存储公式内容'
        ),
        'operator' => array(
            'type' => 'varchar(100)',
            'required' => false,
            'label' => app::get('inventorydepth')->_('操作人'),
            'comment' => ''
        ),
        'update_time' => array(
            'type' => 'last_modify',
            'required' => false,
            'label' => app::get('inventorydepth')->_('最后更新时间'),
            'comment' => ''
        ),
        'operator_ip' => array(
            'type' => 'ipaddr',
            'required' => false,
            'label' => app::get('inventorydepth')->_('操作人IP'),
            'comment' => ''
        )
    ),
    'index' => array(
        'idx_style' => array(
            'columns' => array('style')
        ),
        /*
        'idx_bn' => array(
            'columns' => array('bn')
        ),*/
        'idx_heading' => array(
            'columns' => array('heading')
        )
    ),
    'engine' => 'innodb',
    'version' => '$Rev: $'
);
