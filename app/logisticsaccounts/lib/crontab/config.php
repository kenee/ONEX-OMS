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

/**
 * 加载脚本执行需要的一些框架信息
 */

$root_dir = realpath(dirname(__FILE__) . '/../../../../');
require_once($root_dir."/config/config.php");

define('APP_DIR',ROOT_DIR."/app");

if (PHP_OS == 'WINNT')
    define('PHP_EXEC',dirname(ini_get('extension_dir')).'/php');
else
    define('PHP_EXEC',PHP_BINDIR.'/php');

require_once(APP_DIR.'/base/kernel.php');
@require_once(APP_DIR.'/base/defined.php');

if(!kernel::register_autoload()){
    require(APP_DIR.'/base/autoload.php');
}

base_kvstore::instance('setting/ome')->fetch('sh_base_url', $sh_base_url);
if ( $sh_base_url ){
    define('BASE_URL', $sh_base_url);
}