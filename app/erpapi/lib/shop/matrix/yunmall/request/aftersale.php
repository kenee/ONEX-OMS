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

class erpapi_shop_matrix_yunmall_request_aftersale extends erpapi_shop_request_aftersale
{
    protected function __afterSaleApi($status, $returnInfo=null)
    {
        switch($status)
        {
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
    
    protected function __formatAfterSaleParams($aftersale, $status)
    {
        $params = array(
            'after_sale_order_no' => $aftersale['return_bn'], //退货单号
        );
        
        if($status == '3') {
            $field = 'ship_name,ship_area,ship_addr,ship_tel,ship_mobile,shop_id,order_bn';
            $order = app::get('ome')->model('orders')->db_dump(['order_id'=>$aftersale['order_id']], $field);
            $decrypt_data = kernel::single('ome_security_yunmall')->decrypt(array (
                'ship_tel'    => $order['ship_tel'],
                'ship_mobile' => $order['ship_mobile'],
                'ship_addr'   => $order['ship_addr'],
                'shop_id'     => $order['shop_id'],
                'order_bn'    => $order['order_bn'],
                'ship_name' => $order['ship_name'],
            ), 'order');

            $area = explode(':', $order['ship_area']);
            list($province, $city, $distinct, $town) = explode('/', $area[1]);
            $params['receiver_province'] = $province;
            $params['receiver_city'] = $city;
            $params['receiver_county'] = $distinct;
            $params['receiver_area'] = $town;
            $params['receiver_address'] = $decrypt_data['ship_addr'];
            $params['receiver_name'] = $decrypt_data['ship_name'];
            $params['receiver_phone'] = $decrypt_data['ship_mobile'];
        }elseif($status == '5') {
            $params['reject_reason'] = 'ERP操作'; //拒绝
        }
        
        return $params;
    }

    /**
     * 卖家确认收货
     * @param $data
     */
    public function returnGoodsConfirm($sdf)
    {
        $title = '售后确认收货['.$sdf['return_bn'].']';
        $special = app::get('ome')->model('return_apply_special')->db_dump(['return_id'=>$sdf['return_id']], 'special');
        $special = json_decode($special['special'],1);
        $data = array(
            'after_sale_order_no' => $sdf['return_bn'],
            'biz_type' => $special['biz_type'],
            'buyer_uid' => $special['buyer_uid']
        );
        $this->__caller->call(SHOP_RETURN_GOOD_CONFIRM, $data, array(), $title, 10, $sdf['return_bn']);
    }
}