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


class ome_service_payment{

    /**
     * __construct
     * @param mixed $app app
     * @return mixed 返回值
     */
    public function __construct(&$app)
    {
        $this->app = $app;
    }

    /**
     * 添加付款单
     * @access public
     * @param int $payment_id 付款单ID
     */
    public function payment($payment_id){
        $paymentModel = $this->app->model('payments');
        $payment = $paymentModel->dump($payment_id);
        $res = kernel::single('erpapi_router_request')->set('shop', $payment['shop_id'])->finance_addPayment($payment);
    }

    /**
     * 付款单支付请求
     * @access public
     * @param int $sdf 请求数据
     */
    public function payment_request($payment){
        $res = kernel::single('erpapi_router_request')->set('shop', $payment['shop_id'])->finance_addPayment($payment);
    }

    /**
     * 付款单状态更新
     * @access public
     * @param int $payment_id 付款单ID
     */
    public function status_update($payment_id){

    }
}