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

class openapi_api_params_v1_pda_iostock extends openapi_api_params_abstract implements openapi_api_params_interface{
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
                'pda_token'=>array('type'=>'string','required'=>'true','name'=>'pda_token','desc'=>'用户登录后的凭证(必填项)'),
                'device_code'=>array('type'=>'string','required'=>'true','name'=>'机器码','desc'=>'设备唯一编码(必填项)'),
                'io_type' => array('type'=>'string','required'=>'true','name'=>'入库类型','desc'=>'必填(填数字)。1：采购入库；10：采购退货;4：调拨入库;40：调拨出库;7：直接出库;70：直接入库;300：样品出库;400：样品入库'),
                'io_bn'=>array('type'=>'string','name'=>'出入库单号','desc'=>'如果填写了出入库单号，可以不填时间'),
                'start_time'=>array('type'=>'date','name'=>'开始时间','desc'=>'例如2012-12-08 18:50:30'),
                'end_time'=>array('type'=>'date','name'=>'结束时间','desc'=>'例如2012-12-08 18:50:30'),
                'page_no'=>array('type'=>'number','name'=>'页码','desc'=>'默认1,第一页'),
                'page_size'=>array('type'=>'number','name'=>'每页数量','desc'=>'最大100'),
            ),
            'confirm'=>array(
                'pda_token'=>array('type'=>'string','required'=>'true','name'=>'pda_token','desc'=>'用户登录后的凭证(必填项)'),
                'device_code'=>array('type'=>'string','required'=>'true','name'=>'机器码','desc'=>'设备唯一编码(必填项)'),
                'io_type'=>array('type'=>'number','required'=>'true','name'=>'出入库类型','desc'=>'必填(填数字)。1：采购入库；10：采购退货;4：调拨入库;40：调拨出库;7：直接出库;70：直接入库;300：样品出库;400：样品入库'),
                'io_bn'=>array('type'=>'string','required'=>'true','name'=>'出入库单号','desc'=>'必填'),
                'items'=>array('type'=>'string','required'=>'true','name'=>'出入库明细','desc'=>'必填'),
                'io_status'=>array('type'=>'string','required'=>'true','name'=>'入库状态','desc'=>'必填。部分入库 填：PARTIN ; 入库完成 填：FINISH; 入库取消 天：CANCEL'),
            )
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
            'getList'=>array('name'=>'出入库单查询接口','description'=>'获取待出入库的单据'),
            'confirm'=>array('name'=>'出入库确认','description'=>'采购入库、调拨入库、其他入库')
        );
        return $desccription[$method];
    }
}