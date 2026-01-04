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

$db['order_sync_status'] = array(
    'comment' => '订单同步状态表',
    'columns' => array(
        'order_id' => array(
            'type' => 'table:orders@ome',
            'pkey' => true,
        ),
        'type' => array(
            'type' => 'smallint',
            'default' => '0',
            'label' => '同步类型'
        ),
        'sync_status' => array(
            'type' => 'smallint',
            'default' => '0',
            'comment' => '0:未同步,1:同步失败,2:同步成功',
            'label' => '同步状态'
        ),
    ),
    'comment' => '订单同步状态表',
    'engine' => 'innodb',
    'version' => '$Rev: $'
);
