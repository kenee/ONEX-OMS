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

class openapi_api_params_v1_pda_stock extends openapi_api_params_abstract implements openapi_api_params_interface{

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
            'getAll'=>array(
                'pda_token'=>array('type'=>'string','required'=>'true','name'=>'pda_token','desc'=>'用户登录后的凭证(必填项)'),
                'device_code'=>array('type'=>'string','required'=>'true','name'=>'机器码','desc'=>'设备唯一编码(必填项)'),
                'goods_bn'=>array('type'=>'string','required'=>'false','name'=>'商品编码'),
                'brand_name'=>array('type'=>'string','required'=>'false','name'=>'品牌'),
                'type_name'=>array('type'=>'string','required'=>'false','name'=>'类型'),
                'barcode'=>array('type'=>'string','required'=>'false','name'=>'条形码'),
                'page_no'=>array('type'=>'number','required'=>'true','name'=>'页码','desc'=>'默认1,第一页'),
                'page_size'=>array('type'=>'number','required'=>'true','name'=>'每页数量','desc'=>'最大100'),
            ),
            'getDetailList'=>array(
                    'product_bn'=>array('type'=>'string','required'=>'false','name'=>'货号'),
                    'branch_bn'=>array('type'=>'string','required'=>'false','name'=>'仓库编码'),
                    'store_position'=>array('type'=>'string','required'=>'false','name'=>'货位'),
                    'page_no'=>array('type'=>'number','required'=>'true','name'=>'页码','desc'=>'默认1,第一页'),
                    'page_size'=>array('type'=>'number','required'=>'true','name'=>'每页数量','desc'=>'最大100'),
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
        $description = array('getAll'=>array('name'=>'仓库库存接口','description'=>'返回总数量带仓库明细'),
                             'getDetailList'=>array('name'=>'货位库存接口','description'=>'返回货位库存明细')

    );
        return $description[$method];
    }
}