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

class o2o_delivery_electron {

    /**
     * dealElectron
     * @param mixed $arrDelivery arrDelivery
     * @param mixed $channelId ID
     * @return mixed 返回值
     */
    public function dealElectron(&$arrDelivery, $channelId) {
        $noWaybillBill = array();
        foreach($arrDelivery as $k => $delivery) {
            if(empty($delivery['logi_no'])) {
                $noWaybillBill[$k] = $delivery;
            }
        }
        if(empty($noWaybillBill)) {
            return ['id_bn'=>[]];
        }
        $arrDeliveryId = implode(';', array_slice(array_keys($noWaybillBill), 0, $buffer));
        $rs = kernel::single('o2o_event_trigger_logistics_electron')->directGetWaybill($arrDeliveryId, $channelId);
        $idBn = [];
        if($rs['succ']) {
            foreach ($rs['succ'] as $val) {
                if ($noWaybillBill[$val['delivery_id']]) unset($noWaybillBill[$val['delivery_id']]);
                $arrDelivery[$val['delivery_id']]['logi_no'] = $val['logi_no'];
            }
        }
        if($rs['fail']) {
            foreach ($rs['fail'] as $val) {
                if ($noWaybillBill[$val['delivery_id']]) unset($noWaybillBill[$val['delivery_id']]);
                $idBn[$val['delivery_id']] = array(
                    'bn'=>$val['delivery_bn'],
                    'msg'=>$val['msg']
                );
            }
        }
        if($noWaybillBill) {
            foreach($noWaybillBill as $val) {
                $idBn[$val['delivery_id']] = array(
                    'bn'=>$val['delivery_bn'],
                    'msg'=>'因电子面单接口限制本次未请求',
                    'request_need'=>true
                );
            }
        }
        return array('id_bn'=>$idBn);
    }

}