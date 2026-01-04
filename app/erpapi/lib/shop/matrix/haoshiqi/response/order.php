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
 * @author ykm 2017/10/23
 * @describe 订单处理
 */
class erpapi_shop_matrix_haoshiqi_response_order extends erpapi_shop_response_order
{
    protected $_update_accept_dead_order = true;
    protected function get_update_components()
    {
        $components = array('markmemo','marktype','custommemo');
        if (($this->_ordersdf['pay_status'] != $this->_tgOrder['pay_status']) ||($this->_ordersdf['shipping']['is_cod']=='true' && $this->_ordersdf['status'] == 'dead')) {
            $refundApply = app::get('ome')->model('refund_apply')->getList('apply_id',array('order_id'=>$this->_tgOrder['order_id'],'status|noequal'=>'3'));
            // 如果没有退款申请单，以前端为主
            if (!$refundApply) {
                $components[] = 'master';
            }
        }
        return $components;
    }

    /**
     * 子单状态字符
     *  1.未支付       PAY_NO
        2.已支付       PAY_FINISH
        3.已完成       TRADE_FINISHED
        4.已取消       CANCEL
        5.申请退款     REFUND_APPLICATION
        6.退款中       REFUNDING
        7.已退款       REFUND_FINISHED
        8.拒绝退款     REFUND_REFUSED
     */

    protected function _analysis() {
        parent::_analysis();
        if($this->_ordersdf['pay_status'] == '1') {
            $cancelNum = 0;
            $payNum = 0;
            foreach($this->_ordersdf['order_objects'] as $val) {
                foreach($val['order_items'] as $item) {
                    if(in_array($item['status'], array('PAY_FINISH','TRADE_FINISHED','REFUND_REFUSED'))) {
                        $payNum++;
                    } elseif(in_array($item['status'], array('CANCEL', 'REFUND_FINISHED'))){
                        $cancelNum++;
                    } elseif($item['status'] == 'REFUND_APPLICATION') {
                        $cancelNum = 0;
                        $this->_ordersdf['pay_status'] = '6';
                        break 2;
                    } elseif($item['status'] == 'REFUNDING') {
                        $cancelNum = 0;
                        $this->_ordersdf['pay_status'] = '7';
                        break 2;
                    } elseif($item['status'] == 'PAY_NO') {
                        $cancelNum = 0;
                        $this->_ordersdf['pay_status'] = '0';
                        break 2;
                    }
                }
            }
            if($cancelNum) {
                if($payNum) {
                    $this->_ordersdf['pay_status'] = '4';
                } else {
                    $this->_ordersdf['pay_status'] = '5';
                    $this->_ordersdf['payed'] = 0;
                }
            }
        }
        
        //order_source
        if ($this->_ordersdf['index_field']['is_consignee_encrypt']) {
            if($this->_ordersdf['index_field']['taobao_oaid']) {
                $this->_ordersdf['order_source'] = 'taobao';
            }
            if($this->_ordersdf['index_field']['douyin_open_address_id']) {
                $this->_ordersdf['order_source'] = 'douyin';
            }
            if($this->_ordersdf['index_field']['third_info']) {
                $this->_ordersdf['order_source'] = 'kuaishou';
            }
        }
    }
}
