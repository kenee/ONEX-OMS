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
class base_kvstore_filesystem extends base_kvstore_abstract implements base_interface_kvstore_base
{

    public $header = '<?php exit(); ?>';

    function __construct($prefix) 
    {
        $this->prefix= $prefix;
        $this->header_length = strlen($this->header);
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
        $this->check_dir();
        $data = array();
        $data['value'] = $value;
        $data['ttl'] = $ttl;
        $data['dateline'] = time();
        $org_file = $this->get_store_file($key);
        $tmp_file = $org_file . '.' . str_replace(' ', '.', microtime()) . '.' . mt_rand();
        if(file_put_contents($tmp_file, $this->header.serialize($data))){
            if(copy($tmp_file, $org_file)){
                @unlink($tmp_file);
                return true;
            }
        }
        return false;
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
        $file = $this->get_store_file($key);
        if(file_exists($file)){
            $data = unserialize(substr(file_get_contents($file),$this->header_length));
            if(!isset($data['dateline']))   $data['dateline'] = @filemtime($file);  //todo:兼容老版本
            if($timeout_version < $data['dateline']){
                if(isset($data['expire'])){
                    if($data['expire'] == 0 || $data['expire'] >= time()){
                        $value = $data['value'];
                        return true;
                    }
                    return false;
                    //todo:兼容老版本
                }else{
                    if($data['ttl'] > 0 && ($data['dateline']+$data['ttl']) < time()){
                        return false;
                    }
                    $value = $data['value'];
                    return true;
                }
            }
        }
        return false;
    }//End Function

    /**
     * 删除
     * @param mixed $key key
     * @return mixed 返回值
     */
    public function delete($key) 
    {
        $file = $this->get_store_file($key);
        if(file_exists($file)){
            return @unlink($file);
        }
        return false;
    }//End Function

    /**
     * recovery
     * @param mixed $record record
     * @return mixed 返回值
     */
    public function recovery($record) 
    {
        $this->check_dir();
        $key = $record['key'];
        $data['value'] = $record['value'];
        $data['dateline'] = $record['dateline'];
        $data['ttl'] = $record['ttl'];
        $org_file = $this->get_store_file($key);
        $tmp_file = $org_file . '.' . str_replace(' ', '.', microtime()) . '.' . mt_rand();
        if(file_put_contents($tmp_file, $this->header.serialize($data))){
            if(copy($tmp_file, $org_file)){
                @unlink($tmp_file);
                return true;
            }
        }
        return false;
    }//End Function

    private function check_dir() 
    {
        if(!is_dir(DATA_DIR.'/kvstore/'.$this->prefix)){
            utils::mkdir_p(DATA_DIR.'/kvstore/'.$this->prefix);
        }
    }//End Function

    private function get_store_file($key) 
    {
        return (defined('DATA_DIR') ? DATA_DIR : '').'/kvstore/'.$this->prefix.'/'.$this->create_key($key).'.php';
    }//End Function
}//End Class
