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

class openapi_privilege {

    /**
     * 检查Access
     * @param mixed $flag flag
     * @param mixed $obj obj
     * @param mixed $method method
     * @return mixed 返回验证结果
     */
    static public function checkAccess($flag,$obj,$method){
        if(!$flag){
            return false;
        }

        $settingObj = app::get('openapi')->model('setting');
        $settingInfo = $settingObj->dump(array('code'=>$flag,'status'=>1),'*');
        if($settingInfo){
            if(isset($settingInfo['config'][$obj]) && in_array($method,$settingInfo['config'][$obj])){
                // 将setting信息存储到全局变量中，供API方法使用
                $GLOBALS['openapi_current_setting'] = $settingInfo;
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

}