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

class openapi_api_params_v1_shop extends openapi_api_params_abstract implements openapi_api_params_interface{

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
            'getList'=>array(

                'page_no'=>array('type'=>'number','required'=>'false','name'=>'页码，默认1 第一页'),
                'page_size'=>array('type'=>'number','required'=>'false','name'=>'每页数量，最大100'),
                'shop_code' => array('type'=>'string', 'required'=>'false', 'name'=>'店铺编号', 'desc'=>'店铺编号,多个编号用逗号分隔'),
            ),
            'add'=>array(
                'shop_bn' => array('type'=>'string', 'required'=>'true', 'name'=>'店铺编码'),
                'shop_name' => array('type'=>'string', 'required'=>'true', 'name'=>'店铺名称'),
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
            'getList'=>array('name'=>'查询店铺信息','description'=>'批量获取店铺信息数据'),
            'add'=>array('name'=>'添加店铺','description'=>'添加店铺'),
        );
        return $desccription[$method];
    }
}