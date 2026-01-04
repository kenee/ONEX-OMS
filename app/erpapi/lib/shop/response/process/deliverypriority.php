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
 * 订单挽单
 * Class erpapi_shop_response_process_deliverypriority
 */
class erpapi_shop_response_process_deliverypriority extends erpapi_shop_response_abstract
{
    /**
     * comeback
     * @param mixed $order order
     * @return mixed 返回值
     */

    public function comeback($order)
    {
        $business_type        = ['10001' => '优先发货', '10002' => '催发货'];
        $fulfillment_biz_type = $order['fulfillmentBizType'];
        
        //订单挽回打标
        $orderMdl = app::get('ome')->model('orders');
        switch ($fulfillment_biz_type) {
            case '10001':
                $order_bool_type = $order['order_bool_type'] | ome_order_bool_type::__COME_BACK;
                $title           = $business_type[$fulfillment_biz_type];
                break;
            case '10002':
                $order_bool_type = $order['order_bool_type'] | ome_order_bool_type::__URGENT_DELIVERY;
                $title           = $business_type[$fulfillment_biz_type];
                break;
            default:
                $title = '类型错误';
                break;
        }
        $result = $orderMdl->update(array('order_bool_type' => $order_bool_type), array('order_id' => $order['order_id']));
        if ($result === false) {
            return array('rsp' => 'fail', 'msg' => sprintf('订单%s标识,失败!', $title));
        }
        
        $data = [
            'tid' => $order['order_bn'],
        ];
        
        //日志
        $memo = sprintf('订单%s', $title) . '，时间：' . date('Y-m-d H:i:s', time());
        app::get('ome')->model('operation_log')->write_log('order_modify@ome', $order['order_id'], $memo);
        
        return array('rsp' => 'succ', 'msg' => sprintf('订单%s标识成功!', $title), 'data' => $data);
    }
}