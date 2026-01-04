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

class erpapi_shop_matrix_hupu_request_order extends erpapi_shop_request_order
{
    /**
     * @param $arrOrderBn
     * @return array
     * 1=>’订单创建’,
    2=>’已发货’,
    3=>’订单取消’,
    4=>’订单缺货’,
    5=>’退货中’,
    6=>’已完成’,
     */
    public function getOrderStatus($arrOrderBn)
    {
        $rsp = array('rsp' => 'succ', 'data' => array());
        return array('rsp' => 'fail', 'err_msg' => '接口被禁止'); //已接取消状态
        foreach($arrOrderBn as $orderBn) {
            $params = array('tid' => $orderBn);
            $title = "店铺(" . $this->__channelObj->channel['name'] . ")获取前端店铺" . $orderBn . "的订单状态";
            $tmpRsp = $this->__caller->call(SHOP_GET_ORDER_STATUS, $params, array(), $title, 10, $orderBn);
            if($tmpRsp['rsp'] == 'succ' && $tmpRsp['data']) {
                $data = json_decode($tmpRsp['data'], true);
                if(in_array($data['status'], array('1','2','4','6'))) {
                    $rsp['data'][$orderBn] = true;
                } else {
                    $rsp = array(
                        'rsp' => 'fail',
                        'msg' => $orderBn . '状态不能发货：' . $data['text']
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