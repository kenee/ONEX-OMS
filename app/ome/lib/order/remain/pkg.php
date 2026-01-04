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


class ome_order_remain_pkg {
    
    /*
     * 获取订单编辑的商品类型配置列表
     * @return array conf
     */
    public function diff_money($obj){
        $amount = 0;
        if ($obj['order_items']){
            foreach ($obj['order_items'] as $item){
                if ($item['delete'] == 'true') return 0;
                break;
            }
            
            $amount = ($item['quantity']-$item['sendnum'])/($item['quantity']/$obj['quantity'])*($obj['sale_price']/$obj['quantity']);
        }
        return $amount;
    }
    
    /*
     * 余单撤销处理
     */
    public function remain_cancel($obj){
        if ($obj) {
            $delete = false;
            foreach ($obj['order_items'] as $item){
                if ($item['sendnum'] == 0){
                    $delete = true;
                    break;
                }else {
                    $num = $obj['quantity'] / $item['quantity'] * $item['sendnum'];
                }
            }
            if ($delete == true){
                $sql = "UPDATE `sdb_ome_order_items` SET `delete`='true' WHERE `obj_id`='".$obj['obj_id']."'";//"' AND `sendnum`<`nums` AND `sendnum` = '0' ";
                kernel::database()->exec($sql);
            }else {
                $sql = "UPDATE `sdb_ome_order_items` SET `nums`=`sendnum` WHERE `obj_id`='".$obj['obj_id']."' AND `sendnum`<`nums` AND `sendnum` <> '0' ";
                kernel::database()->exec($sql);
                $sql = "UPDATE `sdb_ome_order_objects` SET `quantity`=".$num." WHERE `obj_id`='".$obj['obj_id']."'";
                kernel::database()->exec($sql);
            }
            return true;
        }
        return false;
    }
    
    /**
     * 获取余单撤消的商品原价
     * @param array $obj
     * @return number
     */
    public function get_order_total_price($obj){
        $amount = 0;
        if ($obj['order_items']){
            foreach ($obj['order_items'] as $item){
                if ($item['delete'] == 'true') return 0;
                break;
            }
            
            $amount = ($item['quantity']-$item['sendnum']) / ($item['quantity']/$obj['quantity']) * $obj['price'];
        }
        
        return $amount;
    }
    
    /**
     * 有订单优惠时,获取余单撤消的商品实付金额
     * @param array $obj
     * @return number
     */
    public function get_order_diff_money($obj){
        $amount = 0;
        if ($obj['order_items']){
            foreach ($obj['order_items'] as $item){
                if ($item['delete'] == 'true') return 0;
                break;
            }
            
            //商品数量被拆分的情况
            if($item['sendnum']){
                $avg_money = number_format($obj['divide_order_fee']/$obj['quantity'], 2, '.', ' ');
                $amount = ($item['quantity']-$item['sendnum']) / ($item['quantity']/$obj['quantity']) * $avg_money;
            }else{
                $amount = $obj['divide_order_fee'];
            }
        }
        
        return $amount;
    }
    
    /**
     * 获取余单撤消的商品优惠金额
     * @param array $obj
     * @return number
     */
    public function get_order_pmt_price($obj){
        $amount = 0;
        if ($obj['order_items']){
            foreach ($obj['order_items'] as $item){
                if ($item['delete'] == 'true') return 0;
                break;
            }
            
            //商品数量被拆分的情况
            if($item['sendnum']){
                $avg_pmt_price = number_format($obj['pmt_price'] / $obj['quantity'], 2, '.', ' ');
                $amount = ($item['quantity']-$item['sendnum']) / ($item['quantity']/$obj['quantity']) * $avg_pmt_price;
            }else{
                $amount = $obj['pmt_price'];
            }
        }
        
        return $amount;
    }
    
    /**
     * 获取余单撤消的订单优惠分摊
     * @param array $obj
     * @return number
     */
    public function get_order_pmt_order_price($obj){
        $amount = 0;
        if ($obj['order_items']){
            foreach ($obj['order_items'] as $item){
                if ($item['delete'] == 'true') return 0;
                break;
            }
            
            //商品数量被拆分的情况
            if($item['sendnum']){
                $avg_pmt_order = number_format($obj['part_mjz_discount'] / $obj['quantity'], 2, '.', ' ');
                $amount = ($item['quantity']-$item['sendnum']) / ($item['quantity']/$obj['quantity']) * $avg_pmt_order;
            }else{
                $amount = $obj['part_mjz_discount'];
            }
        }
        
        return $amount;
    }
}