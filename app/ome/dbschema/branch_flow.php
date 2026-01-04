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

$db['branch_flow'] = array(
    'columns' => array(
        'id'        => array(
            'type'     => 'number',
            'required' => true,
            'pkey'     => true,
            'extra'    => 'auto_increment',
            'editable' => false,
        ),
        'flow_type' => array(
            'type'            => [
                'purchasein' => '采购入库',
                'damagedin'  => '残次入库',
                
            ],
            'label'           => '类型',
            'in_list'         => true,
            'default_in_list' => true,
        ),
        'content'   => array(
            'type'            => 'longtext',
            'required'        => true,
            'in_list'         => true,
            'default_in_list' => true,
            'label'           => '流向',
            'width'         => '240',
        ),
    ),

    'index'   => array(
        'idx_flow_type' => array(
            'columns' => array(
                'flow_type',
            ),
            'prefix'  => 'unique',
        ),
    ),
    'comment' => '货物流转',
    'engine'  => 'innodb',
    'version' => '$Rev: 51996',
);
