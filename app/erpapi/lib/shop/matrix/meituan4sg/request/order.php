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
 * 美团闪购订单处理
 *
 * @category
 * @package
 * @author system
 * @version $Id: order.php
 */
class erpapi_shop_matrix_meituan4sg_request_order extends erpapi_shop_request_order
{
    /**
     * 订单确认接口
     * 调用store.trade.confirm
     */

    public function confirm($order)
    {
        if (empty($order) || empty($order['order_bn'])) {
            return $this->error('订单信息不完整');
        }
        
        // 组织接口参数
        $api_params = array(
            'order_id' => $order['order_bn']
        );
        
        $title = sprintf('美团闪购订单确认[%s]', $order['order_bn']);
        
        // 调用接口，使用父类的callback方法
        $callback = array(
            'class' => get_class($this),
            'method' => 'callback',
        );
        $response = $this->__caller->call(STORE_TRADE_CONFIRM, $api_params, $callback, $title, 10, $order['order_bn']);
        
        return $response;
    }
    
} 