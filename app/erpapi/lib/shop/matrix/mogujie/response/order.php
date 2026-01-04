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
 * 订单处理
 *
 * @category 
 * @package 
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_shop_matrix_mogujie_response_order extends erpapi_shop_response_order
{
    protected $_update_accept_dead_order = true;

    protected function get_update_components()
    {
        $components = array('markmemo','marktype','custommemo');

        // 如果没有收货人信息，
        if (!$this->_tgOrder['consignee']['name'] || !$this->_tgOrder['consignee']['area'] || !$this->_tgOrder['consignee']['addr']) {
            $components[] = 'consignee';
        }

        if ($this->_ordersdf['pay_status'] != $this->_tgOrder['pay_status']) {
            $refundApply = app::get('ome')->model('refund_apply')->getList('apply_id',array('order_id'=>$this->_tgOrder['order_id'],'status|noequal'=>'3'));
            // 如果没有退款申请单，以前端为主
            if (!$refundApply) {
                $components[] = 'master';
            }
        }

        return $components;
    }

    protected function _operationSel()
    {
        parent::_operationSel();

        // 更新收货地址
        if ($this->_tgOrder) {
            if (!$this->_tgOrder['consignee']['name'] 
                || !$this->_tgOrder['consignee']['area'] 
                || !$this->_tgOrder['consignee']['addr']) {
                $this->_operationSel = 'update';
            }
        }
    }

    protected function _analysis()
    {
        parent::_analysis();

        if ($this->_ordersdf['status'] == 'dead' && $this->_ordersdf['shipping']['is_cod'] != 'true'){
            $this->_ordersdf['pay_status'] = '5';
            $this->_ordersdf['payed'] = 0;
        } 
    }
}
