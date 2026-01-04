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

class ome_reship_import{
    
    function run(&$cursor_id, $params, &$error_msg=null)
    {
        if(empty($params["sdfdata"])){
            return false;
        }
        
        $Oreship = app::get('ome')->model('reship');
        $mdl_ome_orders = app::get('ome')->model('orders');
        $rchangeObj = kernel::single('ome_return_rchange');
        $is_auto_approve = app::get('ome')->getConf('return.auto_approve');
        
        foreach($params["sdfdata"] as $var_sdf)
        {
            //检查退换货单是否已经存在
            if($var_sdf['reship_bn']){
                $reshipInfo = $Oreship->dump(array('reship_bn'=>$var_sdf['reship_bn']), 'reship_id');
                if($reshipInfo){
                    $error_msg = '退换货单号：'. $var_sdf['reship_bn'] .'已经存在,不能重复导入';
                    return false;
                }
            }
            
            //检查换出商品是否有错误提示信息
            if(isset($var_sdf['import_error_msg']) && $var_sdf['import_error_msg']){
                $error_msg = '退换货单号：'. $var_sdf['reship_bn'] .'错误，'. $var_sdf['import_error_msg'];
                return false;
            }
            
            //create
            $msg = '';
            $reship_bn = $Oreship->create_treship($var_sdf, $msg);
            if($reship_bn){
                $rs_current_order = $mdl_ome_orders->dump($var_sdf["order_id"],"pay_status");
                if($rs_current_order["pay_status"] == "5"){ //全额退款订单
                    $var_sdf["pay_status"] = "5";
                }
                
                $rchangeObj->update_diff_amount($var_sdf,$reship_bn);
                $reship = $Oreship->getList('reship_id',array('reship_bn'=>$reship_bn),0,1);
                if($is_auto_approve == 'on'){
                    $reshipLib = kernel::single('ome_reship');
                    $reshipLib->batch_reship_queue($reship[0]['reship_id']);
                }
            }
        }
        
        return false;
    }
    
}