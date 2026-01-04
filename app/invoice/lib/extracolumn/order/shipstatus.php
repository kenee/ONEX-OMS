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
 * 发票列表的扩展字段发货状态
 * 20160712
 * @author wangjianjun@shopex.cn
 * @version 1.0
 */
class invoice_extracolumn_order_shipstatus extends invoice_extracolumn_abstract implements invoice_extracolumn_interface{

    protected $__pkey = 'id';

    protected $__extra_column = 'column_ship_status';

    /**
     * 获取发票列表页记录的相关订单的发货状态
     * @param $ids
     * @return array $tmp_array关联数据数组
     */
    public function associatedData($ids){
        //根据主键id拿不重复的order_id
        $mdlInOrder = app::get('invoice')->model('order');
        $rs_invoice = $mdlInOrder->getList("id,order_id",array("id|in"=>$ids));
        $order_ids = array();
        $rl_id_orderid = array(); //主键id和order_id之间的键值关系
        foreach ($rs_invoice as $var_invoice){
            if(!in_array($var_invoice["order_id"], $order_ids)){
                $order_ids[] = $var_invoice["order_id"];
            }
            $rl_id_orderid[$var_invoice["id"]] = $var_invoice["order_id"];
        }
        
        //获取发货状态的数据表枚举关系
        $mdlOmeOrders = app::get('ome')->model('orders');
        $columns = $mdlOmeOrders->schema;
        
        //同一获取订单的发货状态
        $rs_orders = $mdlOmeOrders->getList("order_id,ship_status",array("order_id|in"=>$order_ids));
        $rl_orderid_shipstatus = array(); //order_id和发货状态的键值关系
        foreach ($rs_orders as $var_order){
            $rl_orderid_shipstatus[$var_order["order_id"]] = $columns["columns"]["ship_status"]["type"][$var_order["ship_status"]];
        }
        
        //获取最终的返回数组
        $return_arr = array();
        foreach ($rl_id_orderid as $key_id=>$value_order_id){
            $return_arr[$key_id] = $rl_orderid_shipstatus[$value_order_id];
        }
        
        return $return_arr;
    }

}