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

class erpapi_shop_matrix_shopex_ecstore_request_v3_finance extends erpapi_shop_matrix_shopex_request_finance {

    protected function _updateRefundApplyStatusApi($status, $refundInfo=null){
        $api_method = '';
        switch($status){
            case '3':
                $api_method = SHOP_REFUSE_REFUND;#拒绝退款接口
                break;
        }
        return $api_method;
    }

    protected function _updateRefundApplyStatusParam($refund, $status){
        $params = array();
        $params['refund_id']  = $refund['refund_apply_bn'];
        $params['refuse_message']=$refund['refuse_message'];
        return $params;
    }

    protected function _setParams($refund){
        $params = parent::_setParams($refund);
        $refund_apply_id = $params['refund_apply_id'];
        $refund_applyObj = app::get('ome')->model('refund_apply');
        $refundapply_detail = $refund_applyObj->db->selectrow("SELECT p.return_bn FROM sdb_ome_refund_apply AS r LEFT JOIN sdb_ome_return_product as p ON r.return_id=p.return_id WHERE r.apply_id=".$refund_apply_id);
        $params['aftersale_id'] = $refundapply_detail['return_bn'];
        return $params;
    }

}