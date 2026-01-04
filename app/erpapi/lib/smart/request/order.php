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
 * 订单业务接口类
 *
 * @author wangbiao@shopex.cn
 * @version 2024.04.23
 */
class erpapi_smart_request_order extends erpapi_smart_request_abstract
{
    /**
     * 同步订单获取价格
     *
     * @param $sdf
     * @return array|null
     */
    public function addOrder($sdf)
    {
        $title = $this->__channelObj->wms['channel_name'].'门店同步';
        
        //method
        $method = 'smart.order.add';
        
        //params
        $params = $this->_format_add_params($sdf);
        if (!$params) {
            return $this->error('参数为空,终止同步');
        }
        
        //request
        //$result = $this->call($method, $params, null, $title, 30, $sdf['smart_bn']);
        
        return $this->succ('获取Smart价格成功', '200', $sdf);
    }
    
    protected function _format_add_params($sdf)
    {
        return $sdf;
    }
}
