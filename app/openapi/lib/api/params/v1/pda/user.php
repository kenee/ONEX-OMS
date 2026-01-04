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
/**
 * @author ykm 2017/1/13
 * @describe pda 会员信息认证/取消
 */
class openapi_api_params_v1_pda_user extends openapi_api_params_abstract{

    /**
     * 检查Params
     * @param mixed $method method
     * @param mixed $params 参数
     * @param mixed $sub_msg sub_msg
     * @return mixed 返回验证结果
     */

    public function checkParams($method,$params,&$sub_msg){
        if(parent::checkParams($method,$params,$sub_msg)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 获取AppParams
     * @param mixed $method method
     * @return mixed 返回结果
     */
    public function getAppParams($method){
        $params = array(
            'confirm'=>array(
                'user_name'=>array('type'=>'string','require'=>'true','name'=>'用户名称','desc'=>''),
                'device_code'=>array('type'=>'string','required'=>'true','name'=>'机器码','desc'=>'设备唯一编码(必填项)'),
                'password'=>array('type'=>'string','require'=>'true','name'=>'用户密码','desc'=>'', 'method'=>'passwordMD5'),
            ),
            'cancel'=>array(
                'pda_token'=>array('type'=>'string','require'=>'true','name'=>'pda_token','desc'=>'用户登录后的凭证'),
                'device_code'=>array('type'=>'string','required'=>'true','name'=>'机器码','desc'=>'设备唯一编码(必填项)'),
            ),
        );

        return $params[$method];
    }

    /**
     * passwordMD5
     * @param mixed $key key
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function passwordMD5($key, &$params){
        $params[$key] = md5($params[$key]);
    }

    /**
     * description
     * @param mixed $method method
     * @return mixed 返回值
     */
    public function description($method){
        $desccription = array(
            'check'=>array('name'=>'测试连接接口 ','description'=>'测试用户配置是否正确'),
            'confirm'=>array('name'=>'用户信息验证','description'=>'验证用户名和密码是否正确'),
            'cancel'=>array('name'=>'用户退出登录','description'=>'退出在pda上的登录'),
        );
        return $desccription[$method];
    }
}