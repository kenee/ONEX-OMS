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
 * 订单处理
 *
 * @category 
 * @package 
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_shop_matrix_amazon_response_order extends erpapi_shop_response_order
{
    protected function get_update_components()
    {
        $components = array('markmemo','marktype','custommemo');
        return $components;
    }

    protected function _canAccept()
    {
        if ($this->_ordersdf['t_type'] == 'fenxiao' || $this->_ordersdf['order_source'] == 'taofenxiao') {
            $this->__apilog['result']['msg'] = '分销订单暂时不接收';
            return false;
        }

        if ($this->_ordersdf['trade_type'] == 'AFN') {
            $this->__apilog['result']['msg'] = '不接受配送方式为亚马逊配送的订单';
            return false;
        }

        if (empty($this->_ordersdf['consignee']['addr']) && empty($this->_ordersdf['consignee']['name'])) {
            $this->__apilog['result']['msg'] = '收货人信息不完整';
            return false;
        }

        return parent::_canAccept();
    }

    protected function _analysis()
    {
        parent::_analysis();

        $this->_ordersdf['self_delivery'] = $this->_ordersdf['shipping']['shipping_name'] == '卖家自行配送' ? 'true' : 'false';
    }
}
