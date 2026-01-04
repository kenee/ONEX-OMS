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
 * 20180831 by wangjianjun
 */
class erpapi_shop_matrix_kaola_request_finance extends erpapi_shop_request_finance{

    protected function _updateRefundApplyStatusApi($status, $refundInfo=null){
        $api_method = '';
        switch($status){
            case '2':
                $api_method = SHOP_AGREE_REFUND;
                break;
            case '3':
                $api_method = SHOP_REFUSE_REFUND;
                break;
        }
        return $api_method;
    }

    protected function _updateRefundApplyStatusParam($refund,$status){
        $params = array(
            "refund_id" => $refund["refund_apply_bn"]
        );
        if ($status == '3') { //拒绝
            $params['refund_refuse_reason'] = $refund['refuse_message'];
        }
        if ($status == '2') { //接受
            //$params['refund_remark'] = "";
            //$params['pic'] = "";
        }
        return $params;
    }
   
}
