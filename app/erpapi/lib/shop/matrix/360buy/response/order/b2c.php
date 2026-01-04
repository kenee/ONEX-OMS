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
 * 京东平台
 *
 * @author wangbiao<wangbiao@shopex.cn>
 * @version $Id: Z
 */
class erpapi_shop_matrix_360buy_response_order_b2c extends erpapi_shop_matrix_360buy_response_order
{
    /**
     * 是否接收订单
     *
     * @return bool
     **/

    protected function _canAccept()
    {
        if ($this->_ordersdf['t_type'] == 'fenxiao' || $this->_ordersdf['order_source'] == 'taofenxiao') {
            $this->__apilog['result']['msg'] = '分销订单暂时不接收';
            return false;
        }
        
        //检查京东代销平台
        if($this->__channelObj->channel['business_type'] == 'dx'){
            $this->__apilog['result']['msg'] = '不是京东代销平台的订单,不接收!';
            return false;
        }
        
        //parent
        return parent::_canAccept();
    }
}
