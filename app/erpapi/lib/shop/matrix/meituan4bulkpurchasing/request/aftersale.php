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
 * 美团医药
 */
class erpapi_shop_matrix_meituan4bulkpurchasing_request_aftersale extends erpapi_shop_request_aftersale
{
    protected function __afterSaleApi($status, $aftersale)
    {
        switch ($status) {
            case '3':
                $api_method = SHOP_AGREE_RETURN_GOOD;
                break;
            case '5':
                $api_method = SHOP_REFUSE_RETURN_GOOD;
                break;
            default :
                $api_method = '';
                break;
        }
        return $api_method;
    }
    
    /**
     * __formatAfterSaleParams
     * @param mixed $aftersale aftersale
     * @param mixed $status status
     * @return mixed 返回值
     */

    public function __formatAfterSaleParams($aftersale, $status)
    {
        $params = array();
        $params['refund_id'] = $aftersale['return_bn'];
        $params['remark'] = 'erp操作';
        return $params;
    }
}