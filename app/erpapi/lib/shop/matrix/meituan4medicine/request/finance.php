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
 * [美团医药]店铺退款业务请求Lib类
 */
class erpapi_shop_matrix_meituan4medicine_request_finance extends erpapi_shop_request_finance
{
    protected function _updateRefundApplyStatusApi($status, $refundInfo = null)
    {
        $api_method = '';
        switch ($status) {
            case '2':
                $api_method = SHOP_AGREE_REFUND;
                break;
            case '3':
                $api_method = SHOP_REFUSE_REFUND;
                break;
        }
        
        return $api_method;
    }
    
    /**
     * 退款申请单接口数据
     * @param  array $refund 退款申请单明细
     * @param  string $status 2:已接受申请、3:已拒绝
     * @return [type]         [description]
     */

    public function _updateRefundApplyStatusParam($refund, $status)
    {
        $params = array();
        $reason_id = $refund['reason_id'];
        if ($status == '3') {
            $params['reject_reason_code'] = $reason_id;
        }
        return $params;
    }
}
