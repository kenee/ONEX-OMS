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
 * 商家取消订单审核消息
 * Class erpapi_shop_matrix_360buy_response_bookingrefund
 */
class erpapi_shop_matrix_360buy_response_bookingrefund extends erpapi_shop_response_abstract
{
    /**
     * ordermsg
     * @param mixed $params 参数
     * @return mixed 返回值
     */

    public function ordermsg($params)
    {
        $this->__apilog['title']       = '商家取消订单审';
        $this->__apilog['original_bn'] = $params['orderId'];
        if ($params['auditStatus'] != '1') {
            $this->__apilog['result']['msg'] = '审核不通过';
            return false;
        }
        
        $sdf = [
            'tid'          => $params['orderId'],
            'msg_id'       => '',
            'seller_nick'  => '',
            'user_nick'    => '',
            'call_type'    => 'synchronous',
            'refundStatus' => 1,
            'shop_id'      => $this->__channelObj->channel['shop_id'],
        ];
        return $sdf;
    }
}