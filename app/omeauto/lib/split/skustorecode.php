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
/**
 * 按订单SKU上指定仓拆单(没有地方调用此Lib类)
 * @todo：订单上有多个SKU并且有多个不同的指定仓;
 *
 * @author wangbiao@shopex.cn
 * @version 2023.08.03
 */
class omeauto_split_skustorecode extends omeauto_split_abstract
{
    /**
     * 获取Special
     * @return mixed 返回结果
     */

    public function getSpecial()
    {
        return array();
    }

    /**
     * preSaveSdf
     * @param mixed $sdf sdf
     * @return mixed 返回值
     */
    public function preSaveSdf(&$sdf)
    {
        return array(false, '无需配置，系统默认执行');
    }

    /**
     * splitOrder
     * @param mixed $group group
     * @param mixed $splitConfig 配置
     * @return mixed 返回值
     */
    public function splitOrder(&$group, $splitConfig)
    {
        $orders = $group->getOrders();
        
        //orders
        $orderObjectIds = array();
        foreach($orders as $order_id => $orderInfo)
        {
            foreach($orderInfo['items'] as $itemInfo)
            {
                $obj_id = $itemInfo['obj_id'];
                
                //check
                if($itemInfo['split_num'] == 0){
                    $orderObjectIds[$order_id][$obj_id] = $obj_id;
                }
            }
        }
        
        //check
        $store_code = '';
        $storeCodes = array();
        $objectIds = array();
        foreach($orders as $order_id => $orderInfo)
        {
            foreach($orderInfo['objects'] as $objectInfo)
            {
                $obj_id = $objectInfo['obj_id'];
                
                //check
                if(empty($orderObjectIds[$order_id][$obj_id])){
                    continue;
                }
                
                if(empty($objectInfo['store_code'])){
                    continue;
                }
                
                //取第一个store_code
                $store_code = $objectInfo['store_code'];
                
                break 2;
            }
        }
        
        //check
        if(empty($store_code)) {
            return array(false, '没有指定仓,无需拆单');
        }
        
        //获取仓库
        $appointBranch = kernel::single('ome_branch_type')->isAppointBranch($orderInfo);
        $arrBranch = kernel::single('ome_branch_type')->getBranchIdByStoreCode($store_code, $appointBranch);
        if(!$arrBranch){
            return array(true, '未配置指定仓[' . $store_code . ']', 'no branch');
        }
        
        //获取仓库ID
        $branch_id = $arrBranch[$store_code];
        if(empty($branch_id)) {
            return array(false, '没有指定仓库ID,无需拆单');
        }
        
        //format
        $splitOrder = array();
        $splitOrderId = array();
        foreach ($orders as $order_id => $order)
        {
            $splitOrderId[] = $order['order_id'];
            
            $objects = $order['objects'];
            $itemList = $order['items'];
            
            //unset
            unset($order['objects']);
            unset($order['items']);
            
            //objects(按子单的指定仓拆单)
            $obj_ids = array();
            foreach($objects as $obj_id => $object)
            {
                //check
                if($object['store_code'] != $store_code) {
                    continue;
                }
                
                //初始化订单信息
                if(empty($splitOrder[$order_id])) {
                    $splitOrder[$order_id] = $order;
                }
                
                //objects
                $splitOrder[$order_id]['objects'][$obj_id] = $object;
                
                //obj_ids
                $obj_ids[] = $object['obj_id'];
            }
            
            //check
            if(empty($itemList)){
                continue;
            }
            
            //items
            foreach ($itemList as $item_id => $itemInfo) {
                //按子单的指定仓拆单
                if (in_array($itemInfo['obj_id'], $obj_ids)) {
                    //items
                    $splitOrder[$order_id]['items'][$item_id] = $itemInfo;
                }
            }
        }
        
        $group->setSplitOrderId($splitOrderId);
        $group->updateOrderInfo($splitOrder);
        $group->setBranchId(array($branch_id));
        
        return array(true, '按子单指定仓拆单成功');
    }
}
