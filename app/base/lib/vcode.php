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


class base_vcode {
    
    var $use_gd = false;

    function __construct(){
        if($this->use_gd){
            $this->obj = kernel::single('base_vcode_gd');    
        }else{
            $this->obj = kernel::single('base_vcode_gif');
        }
    }

    function length($len) {
        $this->obj->length($len);
        return true;
    }    
    
    function verify_key($key){
        kernel::single('base_session')->start();
        $_SESSION[$key] = $this->obj->get_code();
    }
    
    static function verify($key,$value){
        kernel::single('base_session')->start();
        if( $_SESSION[$key] == $value ){
            return true;
        }
        return false;
    }
    
    function display(){
        $this->obj->display();
    }
}
