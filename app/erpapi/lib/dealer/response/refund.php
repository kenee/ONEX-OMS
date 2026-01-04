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
 * 售前退款接口
 *
 * @version 2024.04.11
 */
class erpapi_dealer_response_refund extends erpapi_dealer_response_abstract
{
    /**
     * 添加
     * @param mixed $params 参数
     * @return mixed 返回值
     */

    public function add($params)
    {
        $this->__apilog['title'] = '售前退款业务处理[退款单：'. $params['refund_bn'] .',店铺：'. $this->__channelObj->channel['name'] .']';
        $this->__apilog['original_bn'] = $params['order_bn'];
        $this->__apilog['result']['data'] = array('tid'=>$params['order_bn'],'refund_id'=>$params['refund_bn'],'retry'=>'false');
        
        //error_msg
        $this->__apilog['result']['msg'] = '创建退款单不走此接口';
        
        return false;
    }
    
    /**
     * statusUpdate
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function statusUpdate($params)
    {
        $this->__apilog['title'] = '更新退款单状态[退款单：'. $params['refund_bn'] .',店铺：'. $this->__channelObj->channel['name'] .']';
        $this->__apilog['original_bn'] = $params['order_bn'];
        $this->__apilog['result']['data'] = array('tid'=>$params['order_bn'],'refund_id'=>$params['refund_bn'],'retry'=>'false');
        
        //error_msg
        $this->__apilog['result']['msg'] = '更新退款单状态不走此接口';
        
        return false;
    }
}