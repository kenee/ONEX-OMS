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
 * @author ykm 216-01-25
 * @describe 京东电子面单
 */
class wms_event_trigger_logistics_data_electron_aikucun extends wms_event_trigger_logistics_data_electron_common
{

    /**
     * 获取DirectSdf
     * @param mixed $arrDelivery arrDelivery
     * @param mixed $arrBill arrBill
     * @param mixed $shop shop
     * @return mixed 返回结果
     */

    public function getDirectSdf($arrDelivery, $arrBill, $shop) {
        $delivery = $arrDelivery[0];
        if(empty($arrBill)) {
            $this->needRequestId[] = $delivery['delivery_id'];
        } else {
            $this->needRequestId[] = $arrBill[0]['b_id'];
            $delivery['delivery_bn'] = $this->setChildRqOrdNo($delivery['delivery_bn'], $arrBill[0]['b_id']);
        }

        $dOrder = $this->getDeliveryOrder($this->needRequestId);
        $order_bn = $dOrder[0]['order_bn'];
        $shop_type = $dOrder[0]['shop_type'];
        if($shop_type != 'aikucun'){
            return false;
        }

        $primary_bn = uniqid('oet');

        $sdf = parent::getDirectSdf($arrDelivery, $arrBill, $shop);
        $sdf['primary_bn'] = $primary_bn;
        $sdf['order_bn'] = $order_bn;
        $sdf['delivery'] = $delivery;
        return $sdf;
    }





}