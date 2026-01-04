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

class ome_tgservice_updatescript{

    static $default_version = array('basic','pro','center','tperp');

    /**
     * @params operation install:安装,update:升级,uninstall:卸载
     * @params params 用于存储一些额外信息,目前只带 version版本号(类型为 basic,pro,center)
     * @params msg 错误信息
     * @return boolean
     * @author yangminsheng
     **/
    public function exec_command($operation = 'install',$params = array(),&$msg = ''){
        set_time_limit(0);
        if(in_array($params['release_version'],self::$default_version)){
            $obj = kernel::single(sprintf('ome_tgservice_version_%s',$params['release_version']));
            if(method_exists($obj,$operation)){
                ob_start();
                $result = $obj->main($operation,$params,$msg,$obj);
                ob_end_clean();
                return $result;
            }else{
                $msg = $operation.'方法不存在';
                return false;
            }
        }else{
            $msg = $params['version'].'版本暂不存在.';
            return false;
        }
    }
}