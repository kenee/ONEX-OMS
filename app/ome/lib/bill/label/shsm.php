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

#送货上门

class ome_bill_label_shsm {

    /**
     * @param int $orderId
     * @return bool
     */
    public function isTinyPieces($orderId) {
        $billLabelmdl = app::get('ome')->model('bill_label');
        $filter = [
            'bill_type' => 'order',
            'bill_id'   => $orderId,
        ];
        $orderLabelInfo = $billLabelmdl->getList('label_name, label_value', $filter);
        if (!$orderLabelInfo) {
            return false;
        }

        foreach($orderLabelInfo as $v) {
            if( $v['label_name'] == '送货上门'
                && ($v['label_value'] & 0x0002)) {
                return true;
            }
        }
        return false;
    }
}