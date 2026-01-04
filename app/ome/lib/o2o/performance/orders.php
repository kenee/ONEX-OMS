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

class ome_o2o_performance_orders
{

    //门店履约订单状态标记更新
    /**
     * 更新ProcessStatus
     * @param mixed $order_id ID
     * @param mixed $action action
     * @return mixed 返回值
     */
    public function updateProcessStatus($order_id, $action){
        if(empty($order_id)){
            return false;
        }

        switch($action){
            case 'confirm':
                $status = '1';
                break;
            case 'refuse':
                $status = '2';
                break;
            case 'accept':
                $status = '3';
                break;
            case 'consign':
                $status = '4';
                break;
            case 'sign':
                $status = '5';
                break;
        }

        if($status){
            $orderExtendObj = app::get('ome')->model('order_extend');
            $order_extend_info = array('order_id'=>$order_id,'store_process_status'=>$status);
            return $orderExtendObj->save($order_extend_info);
        }else{
            return false;
        }
    }
}