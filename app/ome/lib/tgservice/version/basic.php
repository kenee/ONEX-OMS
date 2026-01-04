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
 * 淘管基础版
 *
 * @package default
 * @author 
 **/
class ome_tgservice_version_basic extends ome_tgservice_version_abstract implements ome_tgservice_version_interface{
    
    protected $release_version = 'tg';

    const VERSION = 'basic';

    public function install($params = array(),&$sass_params = array(),&$msg,&$is_callback = false){
        parent::install($params ,$sass_params ,$msg ,$is_callback);
        if(!empty($this->deploy_info['version'][self::VERSION])){
            foreach((array)$this->deploy_info['version'][self::VERSION] as $app){
                
                if(!app::get($app)->is_installed()){
                    $this->shell->exec_command(sprintf("install %s",$app));
                }
                
            }
        }
        return true;
    }
}
