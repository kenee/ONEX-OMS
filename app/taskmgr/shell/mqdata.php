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

require_once('shell.php');

$mq = new taskmgr_connecter_rabbitmq();

$mq->load('autochk', $GLOBALS['__RABBITMQ_CONFIG']);

for($i=0;$i<10;$i++){

    $data['logi_no'] = 'dly'. sprintf('%05d', $i);
    $data['url'] = 'http://www.baidu.com/?rand=' . rand(1,10000);
    $msg = json_encode($data);
    $mq->publish($msg,'erp.task.autochk.*');
}
