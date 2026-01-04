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

class desktop_csrf
{
    private $_token_key     = '_oms_token_';
    private $_token_expires = 0;
    private $_token_value   = '';
    private $_oms_token_key   = '';
    private $_token_max     = 10;

    /**
     * __construct
     * @param mixed $app app
     * @return mixed 返回值
     */
    public function __construct($app)
    {
        $this->_token_value = uniqid();
        $sessId = kernel::single('base_session')->sess_id();
        $this->_oms_token_key = '_oms_token_.'.$sessId;
    }

    /**
     * 设置_token
     * @return mixed 返回操作结果
     */
    public function set_token()
    {
        $arrTokenKey = cachecore::fetch($this->_oms_token_key);
        if(empty($arrTokenKey)) {
            $arrTokenKey = array();
        }

        array_push($arrTokenKey, $this->_token_value);

        $c = count($arrTokenKey);
        if ($this->_token_max < $c) {
            array_splice($arrTokenKey, 0, $c - $this->_token_max);
        }
        cachecore::store($this->_oms_token_key, $arrTokenKey);
        $cookie_path = str_replace('index.php', '', kernel::base_url());
        if (!$cookie_path) {
            $cookie_path = '/';
        }
        setcookie($this->_token_key, $this->_token_value, 0, $cookie_path, '', false, true);
    }

    /**
     * 获取_token
     * @return mixed 返回结果
     */
    public function get_token()
    {
        return self::$_token_value;
    }

    /**
     * is_valid
     * @return mixed 返回值
     */
    public function is_valid()
    {
        $arrTokenKey = cachecore::fetch($this->_oms_token_key);
        if (!$arrTokenKey) {
            $this->set_token();

            return true;
        }

        $rs = in_array($_COOKIE[$this->_token_key], (array) $arrTokenKey);

        $this->set_token();
        return $rs;
    }
}
