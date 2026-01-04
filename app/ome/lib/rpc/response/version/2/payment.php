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


class ome_rpc_response_version_2_payment extends ome_rpc_response_version_base_payment
{
       
    /**
     * 添加支付单
     * @access public
     * @param array $payment_sdf 付款单标准结构数据
     * @return array('payment_id'=>'付款单主键ID')
     */
    public function add($payment_sdf){
        return array('rsp'=>'success','data'=>array('tid'=>$payment_sdf['order_bn']));
    }
    
    /**
     * 更新付款单状态
     * @access public
     * @param array $status_sdf 付款单状态标准结构数据
     */
    public function status_update($status_sdf){
        return array('rsp'=>'success','data'=>array('tid'=>$payment_sdf['order_bn']));
    }
    
}