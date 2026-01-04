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
 * 平台拆单逻辑
 */
class erpapi_shop_response_plugins_order_platsplit extends erpapi_shop_response_plugins_order_abstract
{

    /**
     * convert
     * @param erpapi_shop_response_abstract $platform platform
     * @return mixed 返回值
     */

    public function convert(erpapi_shop_response_abstract $platform)
    {
        $sdf = [];
        if ($platform->_ordersdf['extend_field']['directParentOrderId']) {
            $sdf['order_bn'] = $platform->_ordersdf['extend_field']['directParentOrderId'];
            $sdf['shop_id']  = $platform->__channelObj->channel['shop_id'];
        }
        return $sdf;
    }

    /**
     * 订单完成后处理
     **/
    public function postCreate($order_id, $sdf)
    {
        $orderMdl = app::get('ome')->model('orders');

        $pOrder = $orderMdl->db_dump([
            'order_bn' => $sdf['order_bn'],
            'shop_id'  => $sdf['shop_id'],
        ], 'process_status,order_id,status,pay_status');

        if ($pOrder) {

            if ($pOrder['status'] == 'active' 
                && in_array($pOrder['process_status'], ['splitting', 'splited'])
            ) {
                $orderMdl->rebackDeliveryByOrderId($pOrder['order_id']);
                $pOrder = $orderMdl->db_dump([
                    'order_bn' => $sdf['order_bn'],
                    'shop_id'  => $sdf['shop_id'],
                ], 'process_status,order_id,status,pay_status');
            }
            if(in_array($pOrder['process_status'], ['unconfirmed', 'confirmed'])) {
                $orderMdl->update(['is_delivery' => 'N'], ['order_id' => $pOrder['order_id']]);
            }
        }
    }

    /**
     * 更新后操作
     *
     * @return void
     * @author
     **/
    public function postUpdate($order_id, $refundapply)
    {
    }
}
