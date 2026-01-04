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
 * ============================
 * @Author:   yaokangming
 * @Version:  1.0
 * @DateTime: 2020/9/10 16:40:32
 * @describe: 拆单数量
 * ============================
 */
class ome_order_object_splitnum
{

    /**
     * 添加DeliverySplitNum
     * @param mixed $orderItems orderItems
     * @return mixed 返回值
     */

    public function addDeliverySplitNum($orderItems)
    {
        if (!is_array($orderItems)) {
            return true;
        }
        $modelItems = app::get('ome')->model('order_items');
        foreach ($orderItems as $item) {
            $rs = $modelItems->updateSplitNum($item['item_id'], $item['number'], '+');
            if ($rs == 0) {
                return false;
            }
        }
        return true;
    }

    /**
     * backDeliverySplitNum
     * @param mixed $deliveryId ID
     * @return mixed 返回值
     */
    public function backDeliverySplitNum($deliveryId)
    {
        $dlyItemsDetailObj = app::get('ome')->model('delivery_items_detail');
        $itemDetailData    = $dlyItemsDetailObj->getList('order_item_id,number', array('delivery_id' => $deliveryId), 0, -1);
        $modelItems        = app::get('ome')->model('order_items');
        foreach ($itemDetailData as $IDVal) {
            $modelItems->updateSplitNum($IDVal['order_item_id'], $IDVal['number'], '-');
        }
    }
}
