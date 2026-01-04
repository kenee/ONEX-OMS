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
 * 美团医药
 */
class erpapi_shop_matrix_meituan4medicine_request_aftersale extends erpapi_shop_request_aftersale
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
     * 卖家确认收货
     * @param $data
     */

    public function returnGoodsConfirm($sdf)
    {
        $title = '售后确认收货['.$sdf['return_bn'].']';
        $returnModel = app::get('ome')->model('return_product');
        $returninfo = $returnModel->db_dump(array('return_id'=>$sdf['return_id'],'source'=>'matrix'),'order_id');
        $orderInfo = app::get('ome')->model('orders')->db_dump(array('order_id'=>$returninfo['order_id']),'order_bn');
        $params['tid'] = $orderInfo['order_bn'];
        $this->__caller->call(SHOP_AGREE_REFUND, $params, array(), $title, 10, $sdf['return_bn']);
    }
    
    public function __formatAfterSaleParams($aftersale, $status)
    {
        $params = array();
        switch ($status)
        {
            case '5':
                $params['reject_reason_code'] = $aftersale['memo']['reject_reason_code'];
                break;
        }
        return $params;
    }
}