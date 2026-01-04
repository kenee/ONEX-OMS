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
 * 导入的发货追回数据队列执行
 * 
 * @Author: wangbiao@shopex.cn
 * @version 0.1
 */

class ome_delivery_refuse_import {
    
    /**
     * 导入的发货追回,最终处理
     * 
     * @param int $cursor_id
     * @param array $params
     * @param string $errmsg
     * @return boolean
     */
    function run(&$cursor_id, $params, &$errmsg){
        $refuseLib = kernel::single('ome_delivery_refuse');
        
        foreach($params['sdfdata'] as $val){
            //组织参数
            $data = array(
                'type' => $val['type'], //导入类型
                'bill_no' => $val['bill_no'], //导入单据号
                'order_id' => $val['data']['order_id'], //订单ID
                'delivery_id' => $val['data']['delivery_id'], //发货单ID
                'branch_id' => $val['data']['branch_id'], //仓库
            );
            
            kernel::database()->beginTransaction();

            //最终处理
            $error_msg = '';
            $result = $refuseLib->finish_refuse($data, $error_msg);
            if(!$result){
                //kernel::log("errmsg = ".$m);
                kernel::database()->rollBack();
                $errmsg .= $error_msg.";";
            }
            kernel::database()->commit();
        }
        
        return false;
    }
}