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

abstract class erpapi_front_response_abstract
{
    public $__channelObj;

    public $__apilog;

    /**
     * __construct
     * @param mixed $app app
     * @return mixed 返回值
     */
    public function __construct($app)
    {
        kernel::single('base_session')->start();

        // 检查是否登陆状态
        $auth    = pam_auth::instance(pam_account::get_account_type('desktop'));
        $account = $auth->account();

        if ($_REQUEST['method'] != 'front.user.login' && !$account->is_valid()) {
            throw new Exception("Invalid Session");
        }
    }

    /**
     * __destruct
     * @return mixed 返回值
     */
    public function __destruct()
    {
        kernel::single('base_session')->close();
    }

    /**
     * 初始化
     * @param erpapi_channel_abstract $channel channel
     * @return mixed 返回值
     */
    public function init(erpapi_channel_abstract $channel)
    {
        $this->__channelObj = $channel;

        return $this;
    }

    /**
     * 去首尾空格
     *
     * @param Array
     * @return Array
     * @author
     **/
    public static function trim(&$arr)
    {
        foreach ($arr as $key => &$value) {
            if (is_array($value)) {
                self::trim($value);
            } elseif (is_string($value)) {
                $value = trim($value);
            }
        }
    }

    /**
     * 过滤空
     *
     * @return void
     * @author
     **/
    public function filter_null($var)
    {
        return !is_null($var) && $var !== '';
    }

    /**
     * 比较数组值
     *
     * @return void
     * @author
     **/
    public function comp_array_value($a, $b)
    {
        if ($a == $b) {
            return 0;
        }

        return $a > $b ? 1 : -1;
    }
}
