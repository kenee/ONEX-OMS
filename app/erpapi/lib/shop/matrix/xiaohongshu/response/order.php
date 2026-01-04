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
 * 小红书订单 by wangjianjun 20170815
 */
class erpapi_shop_matrix_xiaohongshu_response_order extends erpapi_shop_response_order
{
    
    protected $_update_accept_dead_order = true;

    protected function get_update_components()
    {
        $components = array('markmemo','custommemo','marktype','tax');

        if ( ($this->_ordersdf['pay_status'] != $this->_tgOrder['pay_status']) || ($this->_ordersdf['shipping']['is_cod']=='true' && $this->_ordersdf['status'] == 'dead') ) {
            $refundApply = app::get('ome')->model('refund_apply')->getList('apply_id',array('order_id'=>$this->_tgOrder['order_id'],'status|noequal'=>'3'));
            // 如果没有退款申请单，以前端为主
            if (!$refundApply) {
                $components[] = 'master';
            }
        }

        return $components;
    }

    protected function _canCreate()
    {
        if ('false' == app::get('ome')->getConf('ome.platform.rporder.xiaohongshu') && 'RP' == substr($this->_ordersdf['order_bn'], 0, 2)) {
            $this->__apilog['result']['msg'] = '小红书补发单不接收';
            return false;
        }

        return parent::_canCreate();
    }
}
