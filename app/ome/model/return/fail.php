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

class ome_mdl_return_fail extends dbeav_model{
    /**
     * table_name
     * @param mixed $real real
     * @return mixed 返回值
     */
    public function table_name($real=false){
        $table_name = 'return_product';
        if($real){
            return kernel::database()->prefix.'ome_'.$table_name;
        }else{
            return $table_name;
        }
    }
    
    function searchOptions(){
        $parentOptions = parent::searchOptions();
        $childOptions = array(
            'return_bn'=>app::get('base')->_('退货记录流水号'),
            'order_bn'=>app::get('base')->_('订单号'),
            'ship_name'=>app::get('base')->_('收货人'),
            'member_uname'=>app::get('base')->_('用户名'),
            'product_bn'=>app::get('base')->_('货号'),
        );
        return array_merge($parentOptions,$childOptions);
    }

    /**
     * _filter
     * @param mixed $filter filter
     * @param mixed $tableAlias tableAlias
     * @param mixed $baseWhere baseWhere
     * @return mixed 返回值
     */
    public function _filter($filter,$tableAlias=null,$baseWhere=null){
        if(isset($filter['order_bn'])){
            $orderObj = $this->app->model("orders");
            $rows = $orderObj->getList('order_id',array('order_bn|head'=>$filter['order_bn']));
            $orderId[] = 0;
            foreach($rows as $row){
                $orderId[] = $row['order_id'];
            }
            $archive_ordObj = kernel::single('archive_interface_orders');
            $archorder = $archive_ordObj->getOrder_list(array('order_bn'=>$filter['order_bn']),'order_id');
            foreach ($archorder as $arc ) {
                $orderId[] = $arc['order_id'];
            }

            $where .= '  AND order_id IN ('.implode(',', $orderId).')';
            unset($filter['order_bn']);
        }
        if(isset($filter['ship_name'])){
            $deliveryObj = $this->app->model("delivery");
            $rows = $deliveryObj->getList('delivery_id',array('ship_name'=>$filter['ship_name']));
            $deliveryId[] = 0;
            foreach($rows as $row){
                $deliveryId[] = $row['delivery_id'];
            }
            $where .= '  AND delivery_id IN ('.implode(',', $deliveryId).')';
            unset($filter['ship_name']);
        }
        if (isset($filter['member_uname'])){
            $memberObj = $this->app->model("members");
            $rows = $memberObj->getList('member_id',array('uname|has'=>$filter['member_uname']));
            $memberId[] = 0;
            foreach($rows as $row){
                $memberId[] = $row['member_id'];
            }
            $where .= '  AND member_id IN ('.implode(',', $memberId).')';
            unset($filter['member_uname']);
        }
        if (isset($filter['product_bn'])){
            $returnItemObj = $this->app->model("return_product_items");
            $rows = $returnItemObj->getList('return_id',array('bn'=>$filter['product_bn']));
            $returnId[] = 0;
            foreach($rows as $row){
                $returnId[] = $row['return_id'];
            }
            $where .= '  AND return_id IN ('.implode(',', $returnId).')';
            unset($filter['product_bn']);
        }

        return parent::_filter($filter,$tableAlias,$baseWhere).$where;
    }
}
?>