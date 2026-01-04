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
 * 预定退款
 * 20180927 by wangjianjun
 */
class erpapi_shop_response_bookingrefund extends erpapi_shop_response_abstract {

    /**
     * ordermsg
     * @param mixed $params 参数
     * @return mixed 返回值
     */

    public function ordermsg($params){
        $this->__apilog['title'] = '客户有意退款';
        $this->__apilog['original_bn'] = $params['tid'];
        $sdf = [
            'tid' => $params['tid'],
            'msg_id' => $params['msg_id'],
            'seller_nick' => $params['seller_nick'],
            'user_nick' => $params['user_nick'],
            'call_type' => $params['call_type'],
            'oid_list' => $params['oid_list'],
            'refundStatus' => $params['refundStatus'] ? : 1,
            'shop_id' => $this->__channelObj->channel['shop_id'],
        ];
        return $sdf;
    }
    

    /**
     * ordercancle
     * @param mixed $sdf sdf
     * @return mixed 返回值
     */
    public function ordercancle($sdf){

        $this->__apilog['result']['data'] = array('tid'=>$sdf['orderId']);
        $this->__apilog['original_bn']    = $sdf['orderId'];
        $this->__apilog['title']          = '单据取消['.$sdf['orderId'].']';

        $shop_id = $this->__channelObj->channel['shop_id'];
        $data = array(
            'order_bn'      =>  $sdf['orderId'],
            'shop_id'       =>  $shop_id,
            'reason'        =>  $sdf['cancelReason'],

        );

        return $data;

    }
}
