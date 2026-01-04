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
 * 华为商品处理
 */
class inventorydepth_service_shop_kuaishou extends inventorydepth_service_shop_common
{
    public $customLimit = 5;

    /**
     * 下载全部
     **/
    public function downloadList($filter, $shop_id, $offset = 0, $limit = 20, &$errormsg = null)
    {
        $shopService = kernel::single('inventorydepth_rpc_request_shop_items');

        //开始拉取商品
        $result = $shopService->items_all_get($filter, $shop_id, $offset, $limit);
        if ($result === false) {
            $errormsg = $shopService->get_err_msg();
            return false;
        }

        //商品列表
        $itemResult = $result['items']['item'];

        //数据为空
        if (empty($itemResult)) {
            $this->totalResults = 0;
            return array();
        }

        //平台商品总数
        $this->totalResults = intval($result['total']);

        //items
        $data = array();
        foreach ($itemResult as $itemKey => $itemVal) {
            //SKU列表
            $skuArr    = array();
            $goods_num = 0;
            foreach ($itemVal['skuList'] as $k => $v) {
                $skuArr[] = [
                    'num'        => $v['skuStock'],
                    'price'      => $v['skuSalePrice'] / 100,
                    'sku_id'     => $v['kwaiSkuId'],
                    'outer_id'   => $v['skuNick'],
                    'quantity'   => $v['skuStock'],
                    'properties' => $v['specification'],
                    'properties_name' => $v['specification'],
                ];

                $goods_num += $v['skuStock'];
            }

            $data[] = [
                'outer_id'       => '', //商品编码
                'price'          => $itemVal['price'] / 100,
                'num'            => intval($goods_num), //店铺库存
                'iid'            => $itemVal['kwaiItemId'],
                'title'          => $itemVal['details'],
                'approve_status' => $itemVal['shelfStatus'] == '1' ? 'onsale' : 'instock',
                'skus'           => ['sku' => $skuArr],
            ];

        }

        unset($result);

        return $data;
    }
}
