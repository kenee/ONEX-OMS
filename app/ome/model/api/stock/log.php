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

class ome_mdl_api_stock_log extends dbeav_model{
    
    /**
     * 将更新部分库存失败的消息替换
     */
    public function modifier_msg($rows) {
        return str_replace('部分','',$rows);
    }

    public function getLastStockLog($shop_id = '', $product_bn = '', $product_id = '')
    {
        if (!$shop_id || (!$product_bn && !$product_id)) {
            return false;
        }

        $filter = [
            'status'   => 'success',
            'shop_id'  => $shop_id,
            'api_type' => 'request',
        ];
        if ($product_bn) {
            $filter['product_bn'] = $product_bn;
        } else {
            $filter['product_id'] = $product_id;
        }

        $list = $this->getList('*', $filter, 0, 1, 'last_modified desc');
        if (!$list) {
            return false;
        }
        return $list[0];
    }
    
    function _filter($filter,$tableAlias=null,$baseWhere=null)
    {
        if($filter['product_bn'] && is_string($filter['product_bn']) && strpos($filter['product_bn'], "\n") !== false){
            $filter['product_bn'] = array_unique(array_map('trim', array_filter(explode("\n", $filter['product_bn']))));
        }
        return parent::_filter($filter,$tableAlias,$baseWhere);
    }
}
?>