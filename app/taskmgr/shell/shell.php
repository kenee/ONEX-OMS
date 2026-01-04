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

// 定义根目录
define('__ROOT_DIR', dirname(__FILE__) . '/../');

/**
 * 类库自动加载
 *
 * @param string $class_name            
 * @return boolean
 */
function __autoloadOMS($class_name) {
 
    if (stripos($class_name, 'PhpAmqpLib') !== false) {

        return __autoloadAmqpLib($class_name);
    }

    $pos = strpos($class_name, '_');
    
    if ($pos) {
        $owner = substr($class_name, 0, $pos);
        $class_name = substr($class_name, $pos + 1);
        
        $path = __ROOT_DIR . 'lib/' . str_replace('_', '/', $class_name) . '.php';
       
        if (file_exists($path)) {
            
            return require_once $path;
        } else {
            
            return false;
        }
    } else {
        return false;
    }
}


function __autoloadAmqpLib($class_name) {

    $filename = __ROOT_DIR . 'lib/third/' . str_replace("\\", '/', $class_name) . '.php';
    if (file_exists($filename)) {
            
        return require_once $filename;
    } else {
        
        return false;
    }
}

//注册类文件自动引用
if(function_exists('spl_autoload_register')){
    spl_autoload_register('__autoloadOMS');
}else{
    die('Can not register autoload function !!!');
}

//加载配置文件
require_once(__ROOT_DIR . 'config/config.php');