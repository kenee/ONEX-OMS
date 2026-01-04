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

/**
 * 定义打印批次表项表结构
 *
 * @author hzjsq@msn.com
 * @version 0.1b
 */
$db['print_queue_items'] = array(
    'columns' =>
    array(
        'ident' =>
        array(
            'type' => 'varchar(64)',
            'required' => true,
            'editable' => false,
            'in_list' => true,
            'default_in_list' => true,
            'label' => '批次号',
            'comment' => '本次打印的批次号',
        ),
        'delivery_id' => 
        array (
          'type' => 'table:delivery@ome',
          'required' => true,
          'default' => 0,
          'editable' => false,
        ),
       'ident_dly' =>
        array(
            'type' => 'varchar(64)',
            'required' => true,
            'editable' => false,
            'in_list' => true,
            'default_in_list' => true,
            'label' => '批次号序列',
            'comment' => '本次打印的批次号对应的发货单',
        ),
    ),
    'comment' => '打印批次表子表结构',
    'engine' => 'innodb',
    'version' => '$Rev:  $',
);