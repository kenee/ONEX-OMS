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

if (!defined('__CONNECTER_MODE')){
    require_once dirname(__FILE__) . '/../../shell/shell.php';
}

class taskmgr_swprocess_queue
{
    // private static $driver;

    /**
     *
     *
     * @return mixed
     * @author
     **/
    public static function getDriver($taskType)
    {
        $connecterClass = sprintf('taskmgr_connecter_%s', __CONNECTER_MODE);
        $driver   = new $connecterClass();

        $config = strtoupper(sprintf('__%s_CONFIG', __CONNECTER_MODE));

        $isConnect = $driver->load($taskType, $GLOBALS[$config]);
        if (!$isConnect) {
            return null;
        }

        return $driver;
    }

    /**
     * 获取所有队列名
     *
     * @return array
     * @author
     **/
    public static function getKeys()
    {
        $config = strtoupper(sprintf('__%s_CONFIG', __CONNECTER_MODE));

        $queueNames = [];

        $tasks = taskmgr_whitelist::get_all_task_list();
        foreach ($tasks as $key => $value) {
            if (false !== strpos($key, 'domainqueue')) {
                continue;
            }

            $prefix = $GLOBALS[$config]['QUEUE_PREFIX'] ?: 'ERP';

            $queueNames[] = sprintf('%s_TASK_%s_QUEUE', $prefix, strtoupper($key));
        }

        return $queueNames;
    }

    /**
     * 获取队列名
     *
     * @return string
     * @author
     **/
    public static function getKey($key)
    {
        $config = strtoupper(sprintf('__%s_CONFIG', __CONNECTER_MODE));

        $prefix = $GLOBALS[$config]['QUEUE_PREFIX'] ?: 'ERP';

        $name = sprintf('%s_TASK_%s_QUEUE', $prefix, strtoupper($key));

        return $name;
    }

    /**
     * 获取队列长度
     *
     * @return void
     * @author
     **/
    public function count($key)
    {
        $split = explode('_', $key);
        // 弹出第一，第二个
        array_shift($split); array_shift($split); array_pop($split);

        $taskType = strtolower(implode('_', $split));

        $tasks = taskmgr_whitelist::get_all_task_list();

        if (!$tasks[$taskType]) {
            taskmgr_swconsole_output::error(sprintf("队列#%s#不存在", $key) . PHP_EOL);

            exit();
        }

        $driver = self::getDriver($taskType);
        if (!is_object($driver)) {
            taskmgr_swconsole_output::error('队列服务未启用' . PHP_EOL);

            exit();
        }

        return $driver->length();
    }
}
