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
 * 预约退款
 * 20180927 by wangjianjun
 */
class erpapi_shop_request_bookingrefund extends erpapi_shop_request_abstract{
    
    /**
     * orderMsgUpdate
     * @param mixed $sdf sdf
     * @return mixed 返回值
     */

    public function orderMsgUpdate($sdf){
        $order = $sdf['order'];
        $params = array(
            'success'=> $order['pause_status'],
            'tid'=> $order['order_bn'],
            'sub_order_ids'=> $sdf['request_params']['oid_list'],
        );
        if($order["ship_status"] == "1"){ //已发货
            $params["error_code"] = "1001"; //1001代表“已发货拦截失败”
        }
        $title = '订单预约退款回传淘宝店,订单号'.$params['tid'];
        $rsp = $this->__caller->call(SHOP_RDC_ORDERMSG_UPDATE, $params, array(), $title, 10, $params['tid']);
        return $rsp;
    }
    
}
