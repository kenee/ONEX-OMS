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
 * 微盟订单处理
 *
 * @category 
 * @package 
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_shop_matrix_yihaodian_response_order extends erpapi_shop_response_order
{
    protected $_update_accept_dead_order = true;

    protected function get_update_components()
    {
        $components = array('markmemo','custommemo','marktype','tax');

        if ( ($this->_ordersdf['shipping']['is_cod'] == 'true' && $this->_ordersdf['status'] == 'dead')
             || ($this->_ordersdf['shipping']['is_cod'] != 'true' && $this->_ordersdf['pay_status'] == '5')
         ) {
            $components[] = 'master';
        }

        return $components;
    }

    protected function get_create_plugins()
    {
        $plugins = parent::get_create_plugins();

        $plugins[] = 'orderextend';
        return $plugins;
    }

    protected function get_update_plugins()
    {
        $plugins = parent::get_update_plugins();

        $plugins[] = 'orderextend';
        return $plugins;
    }

    protected function _canAccept()
    {
        if ($this->_ordersdf['t_type'] == 'fenxiao' || $this->_ordersdf['order_source'] == 'taofenxiao') {
            $this->__apilog['result']['msg'] = '分销订单暂时不接收';
            return false;
        }

        return parent::_canAccept();
    }

    protected function _analysis()
    {
        if ($this->_ordersdf['status'] == 'dead' && $this->_ordersdf['shipping']['is_cod'] != 'true') $this->_ordersdf['pay_status'] = '5';

        parent::_analysis();

        // 重新计算商品优惠
        $pmt_goods = $cost_item = 0;
        foreach ($this->_ordersdf['order_objects'] as $objkey => $object){
            foreach ($object['order_items'] as $itemkey => $item){
                if($item['status'] == 'close') continue;

                $pmt_goods += (float) $item['pmt_price'];

                $cost_item += $item['amount'] ? (float) $item['amount'] : bcmul((float) $item['price'], $item['quantity'],3);
            }
        }
        
        $total_amount = (float) $cost_item 
                                + (float) $this->_ordersdf['shipping']['cost_shipping'] 
                                + (float) $this->_ordersdf['shipping']['cost_protect'] 
                                + (float) $this->_ordersdf['discount'] 
                                + (float) $this->_ordersdf['cost_tax'] 
                                + (float) $this->_ordersdf['payinfo']['cost_payment'] 
                                - (float) $pmt_goods
                                - (float) $this->_ordersdf['pmt_order'];
        if(0 == bccomp($this->_ordersdf['pmt_goods'], 0,3)
            && 1 == bccomp($pmt_goods, 0,3)
            && 0 == bccomp($total_amount, $this->_ordersdf['total_amount'],3) ){
            $this->_ordersdf['cost_item'] = $cost_item;
            $this->_ordersdf['pmt_goods'] = $pmt_goods;
        }
    }
}
