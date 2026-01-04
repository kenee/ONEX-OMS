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
 * @author ykm 2016/5/24
 * @describe 支付单保存数据
 */
class erpapi_shop_response_process_payment {
    
    /**
     * 添加
     * @param mixed $params 参数
     * @return mixed 返回值
     */

    public function add($params) {
        $t_begin = $params['t_begin'] ?  kernel::single('ome_func')->date2time($params['t_begin']) : time();
        $t_end   = $params['t_end'] ?  kernel::single('ome_func')->date2time($params['t_end']) : time();
        $data = array(
            'payment_bn'     => $params['payment_bn'],
            'shop_id'        => $params['shop_id'],
            'order_id'       => $params['order_info']['order_id'],
            'account'        => $params['account'],
            'bank'           => $params['bank'],
            'pay_account'    => $params['pay_account'],
            'currency'       => $params['currency'] ? $params['currency'] : 'CNY',
            'money'          => (float)$params['money'],
            'paycost'        => $params['paycost'],
            'cur_money'      => (float)$params['cur_money'],
            'pay_type'       => $params['pay_type'] ? $params['pay_type'] : 'online',
            'payment'        => $params['payment'],
            'pay_bn'         => $params['pay_bn'],
            'paymethod'      => $params['paymethod'],
            't_begin'        => $t_begin,
            'download_time'  => time(),
            't_end'          => $t_end,
            'status'         => $params['status'],
            'memo'           => $params['memo'],
            'is_orderupdate' => $params['status'] == 'succ' ? 'true' : 'false',
            'trade_no'       => $params['trade_no'],
        );
        $rs = app::get('ome')->model('payments')->create_payments($data);
        if ($rs) {
            $filter = array('order_id'=>$params['order_info']['order_id']);
            app::get('ome')->model('orders')->update(array('payment' => $params['paymethod']),$filter);
            return array('rsp' => 'succ', 'msg'=>'添加支付单成功', 'data' => array('tid'=>$params['order_bn'],'payment_id'=>$params['payment_bn'],'retry'=>'false'));
        } else {
            return array('rsp' => 'fail', 'msg'=>'添加支付单失败');
        }
    }

    /**
     * statusUpdate
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function statusUpdate($params) {
        $rs = app::get('ome')->model('payments')->update(array('status'=>$params['status']), array('payment_id'=>$params['payment']['payment_id']));
        if(is_bool($rs)) {
            return array('rsp'=>'succ', 'msg'=>'支付单状态为' . $params['status'] . '，不再更新', 'data' => array('tid'=>$params['order_bn'],'payment_id'=>$params['payment_bn'],'retry'=>'false'));
        }
        $tgOrder = $params['order'];
        $tgPayment = $params['payment'];
        // 更新订单状态
        $actual_payed = bcadd($tgOrder['payed'], $tgPayment['money'],3);
        $updateOrder = array();
        $updateOrder['payed'] = (bccomp($actual_payed, $tgOrder['total_amount'],3) == 1) ? $tgOrder['total_amount'] :  $actual_payed;
        $updateOrder['paytime'] = $tgPayment['t_begin'];
        app::get('ome')->model('orders')->update($updateOrder,array('order_id'=>$tgOrder['order_id']));
        kernel::single('ome_order_func')->update_order_pay_status($tgOrder['order_id'], true, __CLASS__.'::'.__FUNCTION__);
        return array('rsp'=>'succ', 'msg'=>'支付单状态更新成功', 'data' => array('tid'=>$params['order_bn'],'payment_id'=>$params['payment_bn'],'retry'=>'false'));
    }
}
