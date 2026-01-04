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

class ome_finder_refunds{
    var $detail_basic = "退款单详情";
    
    function detail_basic($refund_id){
        $render = app::get('ome')->render();
        $oRefunds = app::get('ome')->model('refunds');
        
        $render->pagedata['refund'] = $oRefunds->refund_detail($refund_id);
        $oOrders = app::get('ome')->model('orders');
        $order_id = $render->pagedata['refund']['order_id'];
        $render->pagedata['order'] = $oOrders->order_detail($order_id);
        $render->pagedata['pay_type'] = ome_payment_type::pay_type();
        return $render->fetch('admin/refund/detail.html');
    }
    
    var $addon_cols = 'archive,order_id';
    var $column_order_id='订单号';
    var $column_order_id_width='100';
    function column_order_id($row)
    {
        $archive = $row[$this->col_prefix . 'archive'];
        $order_id = $row[$this->col_prefix . 'order_id'];
        $filter = array('order_id'=>$order_id);
        if ($archive == '1' ) {
            $archive_ordObj = kernel::single('archive_interface_orders');
            $order = $archive_ordObj->getOrders($filter,'order_bn');
        }else{
            $orderObj = app::get('ome')->model('orders');
            $order = $orderObj->dump($filter,'order_bn');
        }
        return $order['order_bn'];
    }
}
?>