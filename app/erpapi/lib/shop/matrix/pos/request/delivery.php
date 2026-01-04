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

define("POS_LOGISTICS_ONLINE_SEND",'orderDeliveryUpdate');
class erpapi_shop_matrix_pos_request_delivery extends erpapi_shop_request_delivery
{
   
   

   protected function get_confirm_params($sdf)
    {

      
        $param = array(
         
            //'api'                   => 'orderDeliveryUpdate',
            'orderNo'               => $sdf['orderinfo']['order_bn'], // 订单号
            'deliveryCompanyCode'   => $sdf['logi_type'], // 物流编号
            'deliveryCompanyName'   => $sdf['logi_name'], // 物流公司
            'deliveryCode'          => $sdf['logi_no'], // 运单号
        );
        

        $orderItems = [];
        $sdf['delivery_items'] = array_values($sdf['delivery_items']);
        foreach($sdf['delivery_items'] as $k=>$v){
            $orderItems[] = array(

                'itemSeqNo' =>  $k+1,
                'skuCode'   =>  $v['bn'],
                'quantity'  =>  $v['number'],
            );
        }
        $param['orderItems'] = $orderItems;
        return $param;
    }


     protected function get_delivery_apiname($sdf)
    {
        return 'orderDeliveryUpdate';
    }

    
}