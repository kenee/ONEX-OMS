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
 * 震坤行
 */
class inventorydepth_service_shop_zkh extends inventorydepth_service_shop_common
{
    public $customLimit = 10;
    
    function __construct(&$app)
    {
        $this->app = $app;
    }
    
    /**
     * 下载全部商品
     */
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
        $itemResult = $result['data'];
        
        //商品总数及分页
        $count = $result['count'];
        
        //数据为空
        if (empty($itemResult)) {
            $this->totalResults = 0;
            return array();
        }
        
        //平台商品总数
        $this->totalResults = intval($count);
        
        //items
        $data = array();
        foreach ($itemResult as $itemKey => $itemVal) {
            $skuCode = $itemVal['zkhSku'];
            if (empty($skuCode)) {
                continue;
            }
            
            //上下架状态
            $approve_status = ($itemVal['skuStatus'] == '1' ? 'onsale' : 'instock');
            
            //sku信息
            $skuList          = array();
            $skuList['sku'][] = array(
                'outer_id' => $itemVal['supplierSkuNo'], //供应商物料号
                'sku_id'   => $itemVal['zkhSku'],
                'title'    => $itemVal['skuName'], //货品名称
            );
            
            //spu信息
            $data[] = array(
                'outer_id'       => $itemVal['supplierSkuNo'] ?? $itemVal['zkhSku'], //spu商品编号
                'iid'            => $itemVal['supplierSkuNo'] ?? $itemVal['zkhSku'],
                'title'          => $itemVal['skuName'], //商品名称
                'approve_status' => $approve_status, //上下架状态
                'simple'         => 'false',
                'skus'           => $skuList,
            );
        }
        
        unset($result);
        
        return $data;
    }
}