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
* 配送方式
*
* @author chenping<chenping@shopex.cn>
* @version $Id: shipping.php 2013-3-12 17:23Z
*/
class erpapi_shop_response_components_order_shipping extends erpapi_shop_response_components_order_abstract
{
    /**
     * 数据格式转换
     *
     * @return void
     * @author 
     **/
    public function convert()
    {
        if ($this->_platform->_ordersdf['shipping']) {
            $this->_platform->_newOrder['shipping']['shipping_name'] = $this->_platform->_ordersdf['shipping']['shipping_name'];
            $this->_platform->_newOrder['shipping']['cost_shipping'] = (float)$this->_platform->_ordersdf['shipping']['cost_shipping'];
            $this->_platform->_newOrder['shipping']['is_protect']    = $this->_platform->_ordersdf['shipping']['is_protect'] ? $this->_platform->_ordersdf['shipping']['is_protect'] : 'false';
            $this->_platform->_newOrder['shipping']['cost_protect']  = (float)$this->_platform->_ordersdf['shipping']['cost_protect'];
            $this->_platform->_newOrder['shipping']['is_cod']        = $this->_platform->_ordersdf['shipping']['is_cod'] == 'true' ? 'true' : 'false';
        }
    }

    /**
     * 
     *
     * @return void
     * @author 
     **/
    public function update()
    {
        if ($this->_platform->_ordersdf['shipping']) {
             $shipping['shipping_name'] = $this->_platform->_ordersdf['shipping']['shipping_name'];
             $shipping['cost_shipping'] = $this->_platform->_ordersdf['shipping']['cost_shipping'];
             $shipping['is_protect']    = $this->_platform->_ordersdf['shipping']['is_protect'];
             $shipping['cost_protect']  = $this->_platform->_ordersdf['shipping']['cost_protect'];
             $shipping['is_cod']        = $this->_platform->_ordersdf['shipping']['is_cod'];

             $shipping = array_filter($shipping,array($this,'filter_null'));
             $diff = array_udiff_assoc($shipping, $this->_platform->_tgOrder['shipping'],array($this,'comp_array_value'));
             if ($diff) {
                 $this->_platform->_newOrder['shipping'] = array_merge((array)$this->_platform->_newOrder['shipping'],$diff);
             }
        }
    }
}