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
 * 
 *
 * @category 
 * @package 
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_shop_matrix_taobao_response_order_b2c extends erpapi_shop_matrix_taobao_response_order
{
    protected $_update_accept_dead_order = true;
    
    protected function _analysis()
    {
        parent::_analysis();

        $pmt = bcadd($this->_ordersdf['pmt_goods'],$this->_ordersdf['pmt_order'],3);
        if (is_array($this->_ordersdf['order_objects']) && count($this->_ordersdf['order_objects']) == 1 && bccomp($this->_ordersdf['cost_item'],$pmt,3) == -1 ) {
            $this->_ordersdf['pmt_order'] = '0';
        }
    }

    protected function get_update_components()
    {
        $components = parent::get_update_components();

        // 到付取消
        if($this->_ordersdf['shipping']['is_cod'] == 'true' && $this->_ordersdf['status'] != 'active'){
            $components[] = 'master';
        }
        
        return $components;
    }

    protected function _canUpdate()
    {
        if ( $this->_ordersdf['status'] == 'dead' && $this->_ordersdf['shipping']['is_cod'] != 'true') {
            $this->__apilog['result']['msg'] = '取消订单不接收';
            return false;
        }

        return parent::_canUpdate();
    }
}
