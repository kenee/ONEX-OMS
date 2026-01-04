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
 * 苏宁自营售后
 * Class erpapi_shop_matrix_suning_request_aftersale
 */
class erpapi_shop_matrix_suning4zy_request_aftersale extends erpapi_shop_request_aftersale {
    protected function __afterSaleApi($status, $returnInfo=null) {
        switch( $status ){
            case '3':
                $api_method = SHOP_AGREE_RETURN_GOOD;
                break;
            case '4':
                $api_method = SHOP_CHECK_REFUND_GOOD;
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

    protected function __formatAfterSaleParams($aftersale,$status) {
        $params = array(
            'refund_id'=>$aftersale['return_bn'],
        );
        switch ($status) {
            case '3':
                break;
            case '4':
                break;
            case '5':
                $oOrder = app::get('ome')->model('orders');
                $order = $oOrder->getList('tostr',array('order_id'=>$aftersale['order_id']),0,-1);
                $platform = json_decode($order[0]['tostr'],true);
                //如果平台订单来自天猫
                if($platform['platform']=='tmall'){
                    $pic_proof = $aftersale['refuse_proof'];
                    $file_name = substr($pic_proof,strripos($pic_proof,'/')+1);
                    $params['pic_proof'] = base64_encode($pic_proof);
                    $params['file_name'] = $file_name;
                }
                $params['reason'] = $aftersale['content'];
                break;
            default: break;
        }
        return $params;
    }
}