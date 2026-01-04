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
 * 京东钱包导入记录表
 *
 * @author AI Assistant
 * @version 1.0
 */

$db['bill_import_jdwallet'] = array(
    'columns' => array(
        'id' => array(
            'type' => 'int(11)',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'comment' => '主键ID',
        ),
        'shop_id' => array(
            'type' => 'varchar(32)',
            'required' => true,
            'comment' => '店铺ID',
        ),
        'shop_name' => array(
            'type' => 'varchar(255)',
            'required' => true,
            'comment' => '店铺名称',
        ),
        'file_name' => array(
            'type' => 'varchar(255)',
            'required' => true,
            'comment' => '文件名',
        ),
        'file_size' => array(
            'type' => 'int(11)',
            'required' => true,
            'comment' => '文件大小（字节）',
        ),
        'import_time' => array(
            'type' => 'int(11)',
            'required' => true,
            'comment' => '导入时间',
        ),
        'status' => array(
            'type' => 'varchar(20)',
            'required' => true,
            'default' => 'processing',
            'comment' => '状态：processing-处理中，chunked-已分片，completed-完成，failed-失败',
        ),
        'settlement_count' => array(
            'type' => 'int(11)',
            'default' => 0,
            'comment' => '结算表记录数',
        ),
        'fund_count' => array(
            'type' => 'int(11)',
            'default' => 0,
            'comment' => '资金表记录数',
        ),
        'settlement_chunks_total' => array(
            'type' => 'int(11)',
            'default' => 0,
            'comment' => '结算表总分片数',
        ),
        'settlement_chunks_completed' => array(
            'type' => 'int(11)',
            'default' => 0,
            'comment' => '结算表已完成分片数',
        ),
        'fund_chunks_total' => array(
            'type' => 'int(11)',
            'default' => 0,
            'comment' => '资金表总分片数',
        ),
        'fund_chunks_completed' => array(
            'type' => 'int(11)',
            'default' => 0,
            'comment' => '资金表已完成分片数',
        ),
        'error_msg' => array(
            'type' => 'text',
            'comment' => '错误信息',
        ),
        'at_time' => array(
            'type' => 'TIMESTAMP',
            'label' => '创建时间',
            'default' => 'CURRENT_TIMESTAMP',
            'comment' => '创建时间',
        ),
        'up_time' => array(
            'type' => 'TIMESTAMP',
            'label' => '更新时间',
            'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'comment' => '更新时间',
        ),
    ),
    'index' => array(
        'idx_shop_id' => array(
            'columns' => array('shop_id'),
        ),
        'idx_status' => array(
            'columns' => array('status'),
        ),
        'idx_import_time' => array(
            'columns' => array('import_time'),
        ),
    ),
    'comment' => '京东钱包导入记录表',
);
