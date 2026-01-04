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

$db['series_products'] = array(
    'columns' => array(
        'sp_id' => array(
            'type' => 'int unsigned',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'label' => '产品线绑物料ID',
        ),
        'series_id' => array(
            'type' => 'int unsigned',
            'label' => '产品线ID',
        ),
        'bm_id' => array(
            'type' => 'int unsigned',
            'label' => '物料ID',
        ),
        'op_name' => array(
            'type' => 'varchar(32)',
            'label' => '创建人',
            'in_list' => true,
        ),
        'at_time'  => array(
            'type'            => 'TIMESTAMP',
            'label'           => '创建时间',
            'default'         => 'CURRENT_TIMESTAMP',
            'width'           => 150,
            // 'in_list'         => true,
            // 'default_in_list' => true,
            'order'           => 40,
        ),
        'up_time'  => array(
            'type'            => 'TIMESTAMP',
            'label'           => '更新时间',
            'default'         => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'width'           => 150,
            // 'in_list'         => true,
            // 'default_in_list' => true,
            'order'           => 50,
        ),
    ),
    'index' => array (
        'ind_series_id' => array(
            'columns' => array(
                'series_id',
            ),
        ),
        'ind_bm_id' => array(
            'columns' => array(
                'bm_id',
            ),
        ),
        'ind_at_time' => array(
            'columns' => array(
                'at_time',
            ),
        ),
        'ind_up_time' => array(
            'columns' => array(
                'up_time',
            ),
        ),
    ),
    'comment' => '产品线绑物料',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);