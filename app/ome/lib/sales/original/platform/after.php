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

class ome_sales_original_platform_after extends ome_sales_original_platform_factory {
    protected $platfomAmount;
    protected $platfomPayAmount;
    /**
     * 初始化Other
     * @param mixed $orderId ID
     * @param mixed $shopType shopType
     * @return mixed 返回值
     */
    public function initOther($orderId, $shopType) {
        $this->platfomAmount = 0;
        $this->platfomPayAmount = 0;
        $reship = app::get('ome')->model('reship')->db_dump(['change_order_id'=>$orderId], 'reship_id');
        if(empty($reship)) {
            return;
        }
        $reshipItems = app::get('ome')->model('reship_items')->getList('num,normal_num,defective_num,order_item_id', ['return_type'=>'return', 'reship_id'=>$reship['reship_id']]);
        if (!$reshipItems) {
            return;
        }
        $orderItemNum = [];
        foreach($reshipItems as $v) {
            if(empty($v['order_item_id'])) {
                return;
            }
            $orderItemNum[$v['order_item_id']] += $v['normal_num'] + $v['defective_num'];
        }
        $saleItems = app::get('ome')->model('sales_items')->getList('nums,order_item_id,platform_amount,platform_pay_amount', ['order_item_id'=>array_column($reshipItems, 'order_item_id')]);
        foreach($saleItems as $v) {
            if($orderItemNum[$v['order_item_id']]) {
                $radio = $orderItemNum[$v['order_item_id']] / $v['nums'];
                $this->platfomAmount += $radio * $v['platform_amount'];
                $this->platfomPayAmount += $radio * $v['platform_pay_amount'];
            }
        }
    }

    /**
     * 获取PlatformAmount
     * @param mixed $obj obj
     * @return mixed 返回结果
     */
    public function getPlatformAmount($obj) {
        $amount = $this->platfomAmount;
        if($amount) {
            $this->platfomAmount = 0;
        }
        return $amount;
    }

    /**
     * 获取PlatformPayAmount
     * @param mixed $obj obj
     * @return mixed 返回结果
     */
    public function getPlatformPayAmount($obj) {
        $amount = $this->platfomPayAmount;
        if($amount) {
            $this->platfomPayAmount = 0;
        }
        return $amount;
    }
}