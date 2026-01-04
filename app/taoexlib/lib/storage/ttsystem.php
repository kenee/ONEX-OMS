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


class taoexlib_storage_ttsystem{

    function taoexlib_storage_ttsystem(){
        $this->memcache=new Memcache;
        $host_mirrors = preg_split('/[,\s]+/',constant('IE_STORAGE_MEMCACHED'));
        if(is_array($host_mirrors) && isset($host_mirrors[0])){
            foreach($host_mirrors as $k =>$v){
                list($host,$port) = explode(":",$v);
                $this->memcache->addServer($host,$port);
            }
        }
    }

    function save($content,&$url,$ext_name){
        $id = $this->_get_ident($ext_name);

        $url = IE_STORAGE_HOST . $id;
        if($this->memcache->set($id,$content)){
            return $id;
        }else{
            return false;
        } 
    }

    function replace($content,$id){
        if($this->memcache->set($id,$content)){
            return $id;
        }else{
            return false;
        }
    }

    function _get_ident($ext_name){    
        return $this->_ident().'.'.$ext_name;
    }


    function remove($id){
        if($id){
            return $this->memcache->delete($id,10);
        }else{
            return true;
        }
    }

    function _ident(){
        return '/'.md5(microtime().base_certificate::get()).'/'.rand(0,time());
    }

    function getFile($id,$type){
        if($type=='public'){
            $f_dir = DATA_DIR.'/public'; 
        }else{
            $f_dir = DATA_DIR.'/private'; 
        }
        $tmpfile = tempnam($f_dir);
        if($id && file_put_contents($tmpfile,$this->memcache->get($id))){
            return $tmpfile;
        }else{
            return true;
        }
    }
    

    function test_get($id){
        return $this->memcache->get($id);

    }

    function get($id){
        return $this->memcache->get($id);
    }
}
