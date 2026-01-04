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


/*
 * @package base
 * @copyright Copyright (c) 2010, shopex. inc
 * @author edwin.lzh@gmail.com
 * @license 
 */
class base_kvstore_flare extends base_kvstore_abstract implements base_interface_kvstore_base
{
    static private $_cacheObj;

    function __construct($prefix) 
    {
        $this->connect();
        $this->prefix = $prefix;
    }//End Function

    /**
     * connect
     * @return mixed 返回值
     */
    public function connect() 
    {
        if(!isset(self::$_cacheObj)){
            if(defined('KVSTORE_MEMCACHE_CONFIG') && constant('KVSTORE_MEMCACHE_CONFIG')){
                self::$_cacheObj = new Memcache;
                $config = explode(',', KVSTORE_MEMCACHE_CONFIG);
                foreach($config AS $row){
                    $row = trim($row);
                    if(strpos($row, 'unix:///') === 0){
                        continue;   //暂不支持
                    }else{
                        $tmp = explode(':', $row);
                        self::$_cacheObj->addServer($tmp[0], $tmp[1]);
                    }
                }
            }else{
                trigger_error('can\'t load KVSTORE_MEMCACHE_CONFIG, please check it', E_USER_ERROR);
            }
        }
    }//End Function

    /**
     * fetch
     * @param mixed $key key
     * @param mixed $value value
     * @param mixed $timeout_version timeout_version
     * @return mixed 返回值
     */
    public function fetch($key, &$value, $timeout_version=null) 
    {
        $store = self::$_cacheObj->get($this->create_key($key));
        if($store !== false){
            if($timeout_version < $store['dateline']){
                if($store['ttl'] > 0 && ($store['dateline']+$store['ttl']) < time()){
                    return false;
                }
                $value = $store['value'];
                return true;
            }
        }
        return false;
    }//End Function

    /**
     * store
     * @param mixed $key key
     * @param mixed $value value
     * @param mixed $ttl ttl
     * @return mixed 返回值
     */
    public function store($key, $value, $ttl=0) 
    {
        $store['key'] = $key;               //todo:持久冗余
        $store['prefix'] = $this->prefix;   //todo:持久冗余
        $store['value'] = $value;
        $store['dateline'] = time();
        $store['ttl'] = $ttl;
        return self::$_cacheObj->set($this->create_key($key), $store, MEMCACHE_COMPRESSED, 0);
    }//End Function

    /**
     * 删除
     * @param mixed $key key
     * @return mixed 返回值
     */
    public function delete($key) 
    {
        return self::$_cacheObj->delete($this->create_key($key));
    }//End Function

    /**
     * recovery
     * @param mixed $record record
     * @return mixed 返回值
     */
    public function recovery($record) 
    {
        $key = $record['key'];
        $store['value'] = $record['value'];
        $store['dateline'] = $record['dateline'];
        $store['ttl'] = $record['ttl'];
        return self::$_cacheObj->set($this->create_key($key), $store, MEMCACHE_COMPRESSED, 0);
    }//End Function

}//End Class