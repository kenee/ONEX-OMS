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

$root_dir = realpath(dirname(__FILE__).'/../../../../');
require_once($root_dir."/script/crontab/runtime.php");

// 库存日报表记录
if ( omequeue_queue::is_allow_exec('03:05') ){
    echo "bpstock begin(".date('Y-m-d H:i:s',time()).")...\n";
    kernel::single('omeanalysts_crontab_script_bpStockDetail')->statistics();
    echo "bpstock end(".date('Y-m-d H:i:s',time()).")...\n";
    exit;
}