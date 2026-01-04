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
 * 苏宁订单处理
 *
 * @category 
 * @package 
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_shop_matrix_shopex_publicb2c_response_order extends erpapi_shop_matrix_shopex_response_order
{
    protected $_update_accept_dead_order = true;
    
    protected function _analysis()
    {
        parent::_analysis();

        // 优惠
        if ($this->_ordersdf['promotion_details'] && is_string($this->_ordersdf['promotion_details'])) {
            $this->_ordersdf['pmt_detail'] = array();
            $pmt_detail = json_decode($this->_ordersdf['promotion_details']);
            foreach ($pmt_detail as $key => $value) {
                $this->_ordersdf['pmt_detail'][$key]['pmt_describe'] = trim($value['promotion_name']);
                $this->_ordersdf['pmt_detail'][$key]['pmt_amount'] = trim($value['promotion_fee']);
            }
        }
    }

    protected function _operationSel()
    {
        parent::_operationSel();

        // 更新0元订单
        $lastmodify = kernel::single('ome_func')->date2time($this->_ordersdf['lastmodify']);
        if (empty($this->_operationSel) && $lastmodify == $this->_tgOrder['outer_lastmodify']) {
            if ($this->_tgOrder['pay_status'] == '0' && $this->_ordersdf['pay_status'] == '1' && 0 == bccomp($this->_ordersdf['total_amount'], 0,3)) {
                $this->_operationSel = 'update';
            }
        }
    }
}
