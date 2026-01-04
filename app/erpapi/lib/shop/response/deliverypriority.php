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
 * 订单挽单
 * Class erpapi_shop_response_deliverypriority
 */
class erpapi_shop_response_deliverypriority extends erpapi_shop_response_abstract
{
    /**
     * comeback
     * @param mixed $params 参数
     * @return mixed 返回值
     */

    public function comeback($params){
        $tid = $params['tid'];
        $title = $params['fulfillmentBizType'] == '10001' ? '挽单' : '催发货';
        $this->__apilog['title']          = sprintf($title.'[%s]', $tid);
        $this->__apilog['original_bn']    = $tid;
        $this->__apilog['result']['data'] = array('tid' => $tid);
        
        if (!$tid) {
            $this->__apilog['result']['msg'] = '缺少订单号';
            return false;
        }
        
        $shop_id = $this->__channelObj->channel['shop_id'];
        
        //检查订单
        $order = $this->getOrder('order_id, order_bn, process_status, status, ship_status, order_bool_type, shop_id', $shop_id, $tid);
        
        if (!$order) {
            $this->__apilog['result']['msg'] = 'ERP不存在此单';
            return false;
        }
        
        if($order['status'] == 'dead'){
            $this->__apilog['result']['msg'] = '订单已作废';
            return false;
        }
        $order['fulfillmentBizType'] = $params['fulfillmentBizType'];
        return $order;
    }
}