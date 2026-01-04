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

/*
 * 获取唯品仓
 */

class purchase_warehouse
{

    /**
     * 获取VopWarehouse
     * @param mixed $shop_id ID
     * @return mixed 返回结果
     */
    public function getVopWarehouse($shop_id)
    {
        $warehouseMdl = app::get('console')->model('warehouse');

        // 获取可用JITX仓库配置
        $result = kernel::single('erpapi_router_request')->set('shop', $shop_id)->branch_getWarehouses();
        if ($result['rsp'] == 'succ') {
            $warehouseMdl->saveWarehouses($result['data']);
        }

        // 获取合作编码信息接口
        $page_size = 1;
        $result    = kernel::single('erpapi_router_request')->set('shop', $shop_id)->branch_getCooperationNoList(['page' => $page_size]);
        if ($result['rsp'] == 'succ') {
            $warehouseMdl->saveCooperation($result['data']);
        }
        while ($result['has_next']) {
            $page_size++;
            $result = kernel::single('erpapi_router_request')->set('shop', $shop_id)->branch_getCooperationNoList(['page' => $page_size]);
            if ($result['rsp'] == 'succ') {
                $warehouseMdl->saveCooperation($result['data']);
            }
        }

        return true;
    }

    // 判断是否是唯品省仓
    /**
     * isVopSc
     * @param mixed $shop_type shop_type
     * @return mixed 返回值
     */
    public function isVopSc($shop_type = '')
    {
        if (!$shop_type || $shop_type != 'vop') {
            return false;
        }
        $shopMdl  = app::get('ome')->model('shop');
        $shopList = $shopMdl->getList('shop_bn', ['shop_type'=>$shop_type]);

        if (!$shopList) {
            return false;
        }

        $branchIdArr = [];
        foreach ($shopList as $k => $shop) {
            // 仓库关联的店铺
            $branchRelationList = app::get('ome')->getConf('shop.branch.relationship');
            $branchRelationList = $branchRelationList[$shop['shop_bn']];

            if (!$branchRelationList) {
                continue;
            }

            $branchIdArr = array_merge($branchIdArr, array_keys($branchRelationList));
        }

        if (!$branchIdArr) {
            return false;
        }

        // 获取仓库管理的平台仓库编码配置中的唯品会JITX编码
        $relation = app::get('ome')->model('branch_relation')->getList('*', ['branch_id|in' => $branchIdArr, 'type' => 'vopjitx']);
        if (!$relation) {
            return false;
        }
        $relation = array_column($relation, 'relation_branch_bn');

        // 用编码去检测是否为省仓
        $warehouseMdl = app::get('console')->model('warehouse');
        $result       = $warehouseMdl->getList('*', ['warehouse_type'=>'2']);
        if (!$result) {
            return false;
        }

        return true;
    }

}
