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
class erpapi_shop_matrix_haoshiqi_request_order extends erpapi_shop_request_order
{

    /**
     * 获取OrderStatus
     * @param mixed $arrOrderBn arrOrderBn
     * @return mixed 返回结果
     */

    public function getOrderStatus($arrOrderBn)
    {
        $rsp = array('rsp' => 'succ', 'data' => array());
        foreach($arrOrderBn as $orderBn) {
            $tmpRsp = $this->get_order_detial($orderBn);
            if($tmpRsp['rsp'] == 'succ') {
                if($tmpRsp['data']['trade']['pay_status'] == 'PAY_FINISH'
                    || ($tmpRsp['data']['trade']['is_cod'] == 'true'
                        && $tmpRsp['data']['trade']['pay_status'] == 'PAY_NO')) {
                    $rsp['data'][$orderBn] = true;
                } else {
                    $rsp = array(
                        'rsp' => 'fail',
                        'msg' => $orderBn . '支付状态不对，可能存在退款'
                    );
                    break;
                }
            } else {
                $rsp = array(
                    'rsp' => 'fail',
                    'msg' => $orderBn . '请求状态失败：' . $tmpRsp['err_msg']
                );
                break;
            }
        }
        return $rsp;
    }
}