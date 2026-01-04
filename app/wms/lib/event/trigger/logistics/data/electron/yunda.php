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

class wms_event_trigger_logistics_data_electron_yunda extends wms_event_trigger_logistics_data_electron_common
{

    /**
     * 获取DirectSdf
     * @param mixed $arrDelivery arrDelivery
     * @param mixed $arrBill arrBill
     * @param mixed $shop shop
     * @return mixed 返回结果
     */
    public function getDirectSdf($arrDelivery, $arrBill, $shop) {
        $deliveryOrder = $this->getDeliveryOrder($this->needRequestDeliveryId);
        $dlyIdOrder = array();
        foreach($deliveryOrder as $val) {
            $dlyIdOrder[$val['wms_delivery_id']][] = $val;
        }
        $deliveryExtend = array();
        foreach($arrDelivery as $delivery) {
            $totalAmount = 0;
            foreach ($dlyIdOrder[$delivery['delivery_id']] as $k => $v) {
                $totalAmount += $v['total_amount'];
            }
            $deliveryItems = $this->getDeliveryItems($delivery['delivery_id']);//发货单明细
            $tmpDelivery = $delivery;
            $tmpDelivery['total_amount'] = $totalAmount;
            $tmpDelivery['delivery_item'] = $deliveryItems;
            $deliveryExtend[] = $tmpDelivery;
            if(empty($arrBill)) {
                $this->needRequestId[] = $delivery['delivery_id'];
            } else {
                $dlyExtend = $deliveryExtend[0];
                $deliveryExtend = array();
                foreach($arrBill as $bill) {
                    $tmp = $dlyExtend;
                    $this->needRequestId[] = $bill['b_id'];
                    $tmp['delivery_bn'] = $this->setChildRqOrdNo($dlyExtend['delivery_bn'], $bill['b_id']);
                    $deliveryExtend[] = $tmp;
                }
                break;
            }
        }
        $primary_bn = uniqid('oey');
        $sdf = parent::getDirectSdf($arrDelivery, $arrBill, $shop);
        $sdf['primary_bn'] = $primary_bn;
        $sdf['shop']       = $shop;
        $sdf['delivery']   = $deliveryExtend;
        return $sdf;
    }
}