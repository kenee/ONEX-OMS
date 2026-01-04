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

class erpapi_shop_matrix_meituan4bulkpurchasing_request_product extends erpapi_shop_request_product
{
    #实时下载店铺商品
    /**
     * itemsAllGet
     * @param mixed $filter filter
     * @param mixed $offset offset
     * @param mixed $limit limit
     * @return mixed 返回值
     */
    public function itemsAllGet($filter, $offset = 0, $limit = 100)
    {
        $timeout = 20;
        $param   = array(
            'page_no'   => $offset,
            'page_size' => $limit,
        );
        $param = array_merge((array) $param, (array) $filter);
        $title = "获取店铺(" . $this->__channelObj->channel['name'] . ')商品';
        $rsp   = $this->__caller->call(SHOP_GET_ITEMS_LIST_RPC, $param, array(), $title, $timeout);

        if ($rsp['data']) {
            $data = json_decode($rsp['data'], 1);
            $rsp['data'] = [];
            if (is_array($data)) {
                $rsp['data'] = $data['data'];
            }
        }

        return $rsp;
    }
}