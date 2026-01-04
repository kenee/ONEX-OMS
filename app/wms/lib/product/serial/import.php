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
 * 唯一码导入队列执行
 * by wangjianjun 20171117
 */
class wms_product_serial_import{
    
    function run(&$cursor_id,$params){
        if(empty($params["sdfdata"])){
            return false;   
        }

        $mdl_ome_ps = app::get('wms')->model('product_serial');
        $operationLogObj = app::get('ome')->model('operation_log');
        foreach($params["sdfdata"] as $var_sdf){
            $insert_arr = array_merge(array("create_time"=>time()),$var_sdf);
            $mdl_ome_ps->insert($insert_arr);
            //write log import serial
            $operationLogObj->write_log('product_serial_import@wms',$insert_arr['serial_id'],'唯一码导入');
        }
        return false;
    }
    
}