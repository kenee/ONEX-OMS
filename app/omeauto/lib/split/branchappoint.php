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
 *    按指定仓库拆
 *
 * @author <chenping@shopex.cn>
 * @datetime 2020-11-08T12:04:21+08:00
 */
class omeauto_split_branchappoint extends omeauto_split_abstract
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
        // 判断是否需要按子单拆分
        $orders = $group->getOrders();

        $store_code = '';
        $is_split   = false;
        foreach ($orders as $order) {
            foreach ($order['objects'] as $object) {
                if ($object['store_code']) {
                    $store_code = $object['store_code'];
                }
            }
        }

        if (!$store_code) {
            return array(false, '无需按子单拆');
        }

        // 取一个订单的类型
        $appointBranch = kernel::single('ome_branch_type')->isAppointBranch($order);
        if($appointBranch) {
            $arrBranch     = kernel::single('ome_branch_type')->getBranchIdByStoreCode($store_code, $appointBranch);
        } else {
            $arrBranch     = kernel::single('ome_branch_type')->getBranchIdByStoreCode($store_code);
        }
        if (!$arrBranch) {
            return array(true, '未配置指定仓[' . $store_code . ']', 'no branch');
        }

        $branch_id = $arrBranch[$store_code];

        // 判断是否为门店
        $branch = app::get('ome')->model('branch')->db_dump($branch_id, 'b_type,b_status,is_negative_store');
        if (app::get('o2o')->is_installed() && $branch['b_type'] == '2') {
            if ($branch['b_status'] == '2') {
                return array(true, '指定门店[' . $store_code . ']停用', 'no branch');
            }
            $group->setStoreBranch();

            $extend  = app::get('ome')->model('order_extend')->db_dump($order['order_id'], 'store_dly_type');
            $dlyType = $extend['store_dly_type'] == 1 ? 'o2o_pickup' : 'o2o_ship';

            $group->setStoreDlyType($dlyType);
        }

        $splitOrder   = array();
        $splitOrderId = array();
        $isOffline    = false;
        foreach ($orders as $order_id => $order) {
            $splitOrderId[] = $order['order_id'];

            $objects = $order['objects'];unset($order['objects']);
            
            $isOffline = $isOffline || ($order['order_type'] == 'offline');

            foreach ($objects as $obj_id => $object) {

                if ($object['store_code'] == $store_code || ($object['obj_type'] == 'gift' && $object['shop_goods_id'] == '-1')) {
                    if(!$splitOrder[$order_id]) {
                        $splitOrder[$order_id] = $order;
                    }
                    $splitOrder[$order_id]['objects'][$obj_id] = $object;

                    if ($object['ship_status'] == '1') {
                        $group->setDeliveryStatus('SHIPED');
                    }
                }
            }
        }

        $group->setSplitOrderId($splitOrderId);
        $group->updateOrderInfo($splitOrder);
        $group->setBranchId(array($branch_id));

        // O2O订单应该可以不用校验库存
        // $group->setConfirmBranch(true);
        // SHIPED && 线下订单=order_type && 仓允许负库存
        // O2O订单如果门店已发货,仓允许负库存，不校验库存
        if ('SHIPED' == $group->getDeliveryStatus() && $branch['is_negative_store'] == 1 && $isOffline) {
            $group->setConfirmBranch(true);
        }

        return array(true, '拆单成功');
    }
}
