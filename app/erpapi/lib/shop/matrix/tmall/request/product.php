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
 * @author ykm 2016-04-29
 * @describe 处理店铺商品相关类
 */
class erpapi_shop_matrix_tmall_request_product extends erpapi_shop_request_product {

    protected function getUpdateStockApi() {
        switch($this->__channelObj->channel['business_type']){
            case 'fx':
                $api_name = SHOP_UPDATE_FENXIAO_ITEMS_QUANTITY_LIST_RPC;
                break;
            default:
                $api_name = SHOP_UPDATE_ITEMS_QUANTITY_LIST_RPC;
                break;
        }

        return $api_name;
    }

    /**
     * format_stocks
     * @param mixed $stocks stocks
     * @return mixed 返回值
     */

    public function format_stocks($stocks)
    {
        $node_type = $this->__channelObj->channel['shop_type'];
        if (kernel::single('inventorydepth_sync_set')->isModeSupportInc($node_type)) {        
            foreach ($stocks as $k => $v) {
                if (isset($v['inc_quantity'])) {
                    $stocks[$k]['quantity_type'] = 'inc'; // 增量库存标识
                }
            }
        }
        return $stocks;
    }
}