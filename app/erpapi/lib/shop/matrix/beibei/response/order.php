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
class erpapi_shop_matrix_beibei_response_order extends erpapi_shop_response_order
{
    protected $_update_accept_dead_order = true;

    protected function get_update_components()
    {
        $components = array('markmemo','marktype','custommemo');

        if(in_array($this->_tgOrder['process_status'], array('unconfirmed'))){
            $rs = app::get('ome')->model('order_extend')->getList('extend_status',array('order_id'=>$this->_tgOrder['order_id']));

            // 如果ERP收货人信息未发生变动时，则更新淘宝收货人信息
            if ($rs[0]['extend_status'] != 'consignee_modified') {
                $components[] = 'consignee';
            }
        }

        // 订单取消
        if ( ($this->_ordersdf['shipping']['is_cod'] == 'true' && $this->_ordersdf['status'] == 'dead')
             || ($this->_ordersdf['shipping']['is_cod'] != 'true' && $this->_ordersdf['pay_status'] == '5')
         ) {
            // 判断是否有ERP退款
            $refundApply = app::get('ome')->model('refund_apply')->getList('apply_id',array('order_id'=>$this->_tgOrder['order_id'],'status|noequal'=>'3'));

            if (!$refundApply) {
                $components[] = 'master';
            }
        }

        return $components;
    }

    protected function _analysis()
    {
        if ($this->_ordersdf['status'] == 'dead' && $this->_ordersdf['shipping']['is_cod'] != 'true') $this->_ordersdf['pay_status'] = '5';

        parent::_analysis();
    }
}
