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
 * 翱象平台通知OMS业务
 *
 * @author wangbiao<wangbiao@shopex.cn>
 * @version 2023.01.05
 */
class erpapi_shop_response_shop extends erpapi_shop_response_abstract 
{
    /**
     * 翱象系统通知签约信息给到OMS
     * method：alibaba.dchain.aoxiang.sign.seller.notify
     *
     * @param array $params
     * @return array
     */
    public function aoxiang_signed($params)
    {
        $this->__apilog['title'] = '翱象系统通知签约信息';
        $this->__apilog['original_bn'] = $params['bizRequestId'];
        
        $sdf = $this->_formatSignedParams($params);
        
        return $sdf;
    }
    
    /**
     * 格式化签约信息参数
     *
     * @param array $params
     * @return array
     */
    protected function _formatSignedParams($params)
    {
        $sdf = array(
            'bizRequestId' => $params['bizRequestId'], //业务请求ID，用于做幂等
            'bizRequestTime' => $params['bizRequestTime'], //业务请求时间戳(毫秒)
            'signed_type' => $params['signed_method'], //操作方法:sign(签约)、cancel(取消签约)
            'shop_id' => $this->__channelObj->channel['shop_id'], //OMS店铺shop_id
        );
        
        //转换时间
        if($sdf['bizRequestTime']){
            $sdf['bizRequestTime'] = ceil($sdf['bizRequestTime'] / 1000);
        }
        
        return $sdf;
    }
}