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
 * [释放库存]唯品会实时销售订单创建时会提前预占库存
 * @todo：导航栏目-->唯品会JIT-->销售订单
 *
 * @author wangbiao@shopex.cn
 * @version 2025.03.21
 */
class erpapi_shop_response_plugins_order_inventory extends erpapi_shop_response_plugins_order_abstract
{
    /**
     * convert
     * @param erpapi_shop_response_abstract $platform platform
     * @return mixed 返回值
     */

    public function convert(erpapi_shop_response_abstract $platform)
    {
        $inventoryOrderMdl = app::get('console')->model('inventory_orders');
        
        //order_bn
        $order_bn = $platform->_ordersdf['order_bn'];
        
        //info
        $inventoryOrderInfo = $inventoryOrderMdl->dump(array('order_sn'=>$order_bn), 'id,order_sn,dispose_status');
        if(in_array($inventoryOrderInfo['dispose_status'], array('finish','needless','cancel'))){
            $inventoryOrderInfo = array();
        }
        
        return $inventoryOrderInfo;
    }
    
    /**
     * 订单完成后处理
     * 
     * @param $order_id
     * @param $inventoryOrderInfo
     * @return array
     */
    public function postCreate($order_id, $inventoryOrderInfo)
    {
        //核销处理订单
        $paramsFilter = array('id'=>$inventoryOrderInfo['id']);
        $result = kernel::single('console_inventory_orders')->disposeInventoryOrders($paramsFilter);
        
        return $result;
    }
    
    /**
     * 订单更新后处理
     * 
     * @param $order_id
     * @param $inventoryOrderInfo
     * @return void
     */
    public function postUpdate($order_id, $inventoryOrderInfo)
    {
        return true;
    }
}
