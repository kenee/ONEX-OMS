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
 * WMS 发货单

 */
class erpapi_wms_response_receiverinfo extends erpapi_wms_response_abstract
{

    # wms.receiverinfo.query
    /**
     * query
     * @param mixed $params 参数
     * @return mixed 返回值
     */

    public function query($params){
        // 参数校验
        $this->__apilog['title']       = $this->__channelObj->channel['channel_name'] . '发货单' . $params['delivery_order_code'] .',地址明文查询';
        $this->__apilog['original_bn'] = $params['delivery_order_code'];


        $data = array(
            'delivery_bn'    => trim($params['delivery_order_code']),
            'oaid'           => $params['oaid'],
            'branch_bn'      => $params['owner_code'],
        );
        return $data;
    }
}
