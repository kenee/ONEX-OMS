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

class siso_receipt_sales_sold extends siso_receipt_sales_abstract implements siso_receipt_sales_interface{

    /**
     *
     * 根据参数组织订单销售的销售单数据
     * @param array $params
     */
    public function get_sales_data($params){
        $order_original_data = array();
        $sales_data = array();
        $delivery_id = $params['delivery_id'];

        $deliveryObj = app::get('ome')->model('delivery');
        $orderIds = $deliveryObj->getOrderIdsByDeliveryIds(array($delivery_id));
        $db = kernel::database();
        $ome_original_dataLib = kernel::single('ome_sales_original_data');
        $ome_sales_dataLib = kernel::single('ome_sales_data');
        foreach ($orderIds as $key => $orderId){
            //判断订单是否已经生成过销售单
            $sales_detail = $db->selectrow("SELECT sale_id FROM sdb_ome_sales WHERE order_id=".$orderId);
            if ($sales_detail) return false;
            $order_original_data = $ome_original_dataLib->init($orderId);
            if($order_original_data){
                $sales_data[$orderId] = $ome_sales_dataLib->generate($order_original_data,$delivery_id);
                if(!$sales_data[$orderId]){
                    return false;
                }
            }else{
                return false;
            }
            unset($order_original_data);
        }

        //平摊预估物流运费，主要处理订单合并发货以及多包裹单的运费问题
        $ome_sales_logistics_feeLib = kernel::single('ome_sales_logistics_fee');
        $ome_sales_logistics_feeLib->calculate($orderIds,$sales_data);

        return $sales_data;

    }

/**
 * @ 根据ID获取delivery_items_detail LIST
 * @DateTime  2018-03-02T13:51:41+0800
 * @param    $order_id
 * @return    array
 */
    public function get_delivery_detail($order_id)
    {
        static $delivery_items = array();

        if ($delivery_items[$order_id]) return $delivery_items[$order_id];

        $delivery_items_detailObj = app::get('ome')->model('delivery_items_detail');
        $item_list   = $delivery_items_detailObj->getList('order_id,item_detail_id, order_item_id, order_obj_id, number', array('order_id'=>$order_id));
        foreach($item_list as $item){
            $delivery_items[$item['order_id']][$item['order_obj_id']][$item['order_item_id']]   =   $item;
        }

        return $delivery_items[$order_id];
    }
}
