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


/*
 * @package base
 * @copyright Copyright (c) 2010, shopex. inc
 * @author edwin.lzh@gmail.com
 * @license 
 */
class base_kvstore_dba extends base_kvstore_abstract implements base_interface_kvstore_base
{
    private $rs = null;
    private $handle = 'db4';

    function __construct($prefix) 
    {
        if(!is_dir(DATA_DIR.'/kvstore/')){
            utils::mkdir_p(DATA_DIR.'/kvstore/');
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
        $rs = dba_open(DATA_DIR.'/kvstore/dba.db','r-',$this->handle);
        $store = dba_fetch($this->create_key($key),$rs);
        dba_close($rs);
        $store = unserialize($store);
        if($store !== false && $timeout_version < $store['dateline']){
            if($store['ttl'] > 0 && ($store['dateline']+$store['ttl']) < time()){
                return false;
            }
            $value = $store['value'];
            return true;
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
        $store['value'] = $value;
        $store['dateline'] = time();
        $store['ttl'] = $ttl;
        $rs = dba_open(DATA_DIR.'/kvstore/dba.db','cl',$this->handle);
        $ret = dba_replace($this->create_key($key), serialize($store), $rs);
        dba_close($rs);
        return $ret;
    }//End Function

    /**
     * 删除
     * @param mixed $key key
     * @return mixed 返回值
     */
    public function delete($key) 
    {
        $rs = dba_open(DATA_DIR.'/kvstore/dba.db','wl',$this->handle);
        $ret = dba_delete($this->create_key($key),$rs);
        dba_close($rs);
        return $ret;
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
        $rs = dba_open(DATA_DIR.'/kvstore/dba.db','cl',$this->handle);
        $ret = dba_replace($this->create_key($key), serialize($store), $rs);
        dba_close($rs);
        return $ret;
    }//End Function

}//End Class
