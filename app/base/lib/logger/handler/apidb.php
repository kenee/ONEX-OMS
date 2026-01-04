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

use Monolog\Level;
use Monolog\LogRecord;
use Monolog\Handler\AbstractProcessingHandler;

class base_logger_handler_apidb extends AbstractProcessingHandler
{
    private $apiMdl;

    public function __construct(int|string|Level $level = Level::Debug, bool $bubble = true)
    {
        $this->apiMdl = app::get('ome')->model('api_log');

        parent::__construct($level, $bubble);
    }

    protected function write(LogRecord $record): void
    {
        $data = [
            'log_id' =>  uniqid('', true),
            'original_bn' => $record->context['original_bn'],
            'task_name' => $record->message,
            'status' => $record->context['status'] ?: null,
            'worker' => $record->context['worker'] ?: null,
            'params' => $record->context['params'] ? json_encode($record->context['params']) : null,
            'addon' => $record->extra ? json_encode($record->extra) : null,
            'msg' => $record->context['msg'],
            'log_type' => $record->channel,
            'api_type' => $record->context['api_type'],
            'error_lv' => $record->level->getName(),
            'msg_id' => $record->context['msg_id'],
            'unique' => $record->extra['uid'],
            'createtime' => $record->datetime->getTimestamp(),
            'spendtime' => $record->context['original_bn'],
        ];

        $this->apiMdl->insert($data);
    }
}