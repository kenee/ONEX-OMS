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
 * @desc
 * @author: jintao
 * @since: 2016/7/20
 */
class erpapi_shop_matrix_taobao_request_aftersale extends erpapi_shop_request_aftersale {
    protected function __afterSaleApi($status, $returnInfo=null) {
        switch( $status ){
            case '3':
                $api_method = SHOP_AGREE_RETURN_GOOD;
                break;
            case '5':
                $api_method = SHOP_REFUSE_REFUND;
                break;
            default :
                $api_method = '';
                break;
        }
        return $api_method;
    }

    protected function __formatAfterSaleParams($aftersale,$status) {
        $shop_id = $this->__channelObj->channel['shop_id'];
        $oReturn_tb = app::get('ome')->model('return_product_taobao');
        $return_tb = $oReturn_tb->dump(array('shop_id'=>$shop_id,'return_id'=>$aftersale['return_id']));

        $params = array(
            'refund_id'=>$aftersale['return_bn'],
        );
        $params['oid'] = $return_tb['oid'];
        $oReturn_address = app::get('ome')->model('return_address');
        $address = $oReturn_address->getDefaultAddress($shop_id);
        switch ($status) {
            case '3':
                $batchList = kernel::single('ome_refund_apply')->return_batch('accept_return');
                $return_batch = $batchList[$shop_id];
                $params['receiver_name'] = $return_tb['reship_name'] ? $return_tb['reship_name'] : $address['contact_name'];
                $params['receiver_address'] = $return_tb['reship_addr']? $return_tb['reship_addr'] :$address['address'];
                $params['receiver_zip'] = $return_tb['reship_zip'] ? $return_tb['reship_zip'] : $address['zip_code'];
                $params['receiver_phone'] = $return_tb['reship_phone'] ? $return_tb['reship_phone']: $address['tel'];
                $params['receiver_mobile'] = $return_tb['reship_mobile'] ? $return_tb['reship_mobile']:$address['mobile_phone'];
                $params['memo'] = $return_batch['memo'];
                $params['seller_address_id'] = $address['contact_id'];
                break;
            case '5':
                $params['refuse_message'] = $aftersale['refuse_message'];
                $params['refuse_proof']   = $aftersale['refuse_proof'];
                break;
            default: break;
        }
        return $params;
    }
}