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

class openapi_api_params_v1_member extends openapi_api_params_abstract implements openapi_api_params_interface{
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
            'add'=>array(
                'uname' => array('type'=>'string', 'required'=>'true', 'name'=>'会员名'),
                'name' => array('type'=>'string', 'required'=>'true', 'name'=>'会员昵称'),
                'shop_bn' => array('type'=>'string', 'required'=>'true', 'name'=>'店铺编码'),
                // 'buyer_open_uid' => array('type'=>'string', 'required'=>'true', 'name'=>'买家open_uid'),
            ),
            'edit'=>array(
                'uname' => array('type'=>'string', 'required'=>'true', 'name'=>'会员名'),
                'name' => array('type'=>'string', 'required'=>'true', 'name'=>'会员昵称'),
                'shop_bn' => array('type'=>'string', 'required'=>'true', 'name'=>'店铺编码'),
                // 'buyer_open_uid' => array('type'=>'string', 'required'=>'true', 'name'=>'买家open_uid'),
            ),
        );

        return $params[$method];
    }

    /**
     * description
     * @param mixed $method method
     * @return mixed 返回值
     */
    public function description($method){
        $desccription = array(
            'add'=>array('name'=>'新建会员','description'=>'新建会员'),
            'edit'=>array('name'=>'编辑会员','description'=>'编辑会员'),
        );
        return $desccription[$method];
    }
}