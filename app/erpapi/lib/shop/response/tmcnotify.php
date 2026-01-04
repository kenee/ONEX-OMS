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
 * ============================
 * @Author:   yaokangming
 * @Version:  1.0
 * @DateTime: 2022/9/30 10:21:09
 * @describe: tmc消息通知
 * ============================
 */
class erpapi_shop_response_tmcnotify extends erpapi_shop_response_abstract {

    /**
     * refund
     * @param mixed $params 参数
     * @return mixed 返回值
     */

    public function refund($params){
        $params = json_decode($params['content'], 1);
        $this->__apilog['title'] = '退款消息通知';
        $this->__apilog['original_bn'] = $params['tid'];
        if(!defined('TMC_REFUND_WRITE_MODE')) {
            $this->__apilog['result']['msg'] = '未配置消息接收';
            return false;
        }
        $sdf = [
            'tid' => $params['tid'],
            'oid' => $params['oid'],
            'buyer_nick' => $params['buyer_nick'],
            'buyer_open_uid' => $params['buyer_open_uid'],
            'seller_nick' => $params['seller_nick'],
            'refund_phase' => $params['refund_phase'],
            'modified' => $params['modified'],
            'bill_type' => $params['bill_type'],
            'refund_id' => $params['refund_id'],
            'shop_id' => $this->__channelObj->channel['shop_id'],
            'node_id' => $this->__channelObj->channel['node_id'],
        ];
        return $sdf;
    }
    
}
