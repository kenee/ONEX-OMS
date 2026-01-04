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


class ome_service_order_remain_goods {
    
    /*
     * 获取订单编辑的商品类型配置列表
     * @return array conf
     */
    public function diff_money($obj){
        $amount = 0;
        if ($service = kernel::service("ome.service.order.object.diff.goods")){
            if (method_exists($service, 'diff_money')) $amount = $service->diff_money($obj);
        }
        return $amount;
        //return kernel::single("ome_order_remain_goods")->diff_money($obj);
    }

    /*
     * 余单撤销处理
     */
    public function remain_cancel($obj){
        return kernel::single("ome_order_remain_goods")->remain_cancel($obj);
    }
}