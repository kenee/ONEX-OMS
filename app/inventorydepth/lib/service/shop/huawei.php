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
class inventorydepth_service_shop_huawei extends inventorydepth_service_shop_common
{
    //定义每页拉取数量(平台限制每页最多20条)
    public $customLimit = 20;
    
    function __construct(&$app)
    {
        $this->app = $app;
    }
    
    /**
     * 下载全部
     **/
    public function downloadList($filter, $shop_id, $offset=0, $limit=20, &$errormsg=null)
    {
        $shopService = kernel::single('inventorydepth_rpc_request_shop_items');
        
        //开始拉取商品
        $result = $shopService->items_all_get($filter, $shop_id, $offset, $limit);
        if($result === false){
            $errormsg = $shopService->get_err_msg();
            return false;
        }
        
        //商品列表
        $itemResult = $result['result']['data']['sbomList'];
        
        //商品总数及分页
        $pageResult = $result['result']['data']['page'];
        
        //数据为空
        if(empty($itemResult)){
            $this->totalResults = 0;
            return array();
        }
        
        //平台商品总数
        $this->totalResults = intval($pageResult['totalRow']);
        
        //items
        $data = array();
        foreach ($itemResult as $itemKey => $itemVal)
        {
            $skuCode = $itemVal['skuCode'];
            if(empty($skuCode)){
                continue;
            }
            
            /***
            //拉取单个商品详细信息
            $getItemData = $shopService->item_get($skuCode, $shop_id);
            if ($getItemData === false){
                $errormsg[] = $value['iid'].'：'.$shopService->get_err_msg();
                continue;
            }
            
            $skuInfo = $getItemData['result']['data']['sbom'];
            if(empty($skuInfo)){
                $errormsg[] = $skuCode.'不存在商品详细信息！';
                continue;
            }
            ***/
            
            //上下架状态
            $approve_status = ($itemVal['status']=='2' ? 'onsale' : 'instock');
            
            //sku信息
            $skuList = array();
            $skuList['sku'][] = array(
                    'outer_id' => $itemVal['skuCode'], //sku货号
                    'sku_id' => $itemVal['skuCode'],
                    'title' => $itemVal['skuName'], //货品名称
                    'price' => $itemVal['price'],
                    //'quantity' => 0, //店铺库存
            );
            
            //spu信息
            $data[] = array(
                    //'outer_id' => $itemVal['productCode'], //spu商品编号
                    //'iid' => $itemVal['productCode'], //spu_id
                    'outer_id' => $itemVal['skuCode'], //spu商品编号
                    'iid' => $itemVal['skuCode'], //spu_id
                    'title' => $itemVal['productName'], //商品名称
                    'approve_status' => $approve_status, //上下架状态
                    'price' => $itemVal['price'],
                    //'num' => 0, //店铺库存
                    'simple' => 'false',
                    'skus' => $skuList,
            );
        }
        
        unset($result, $getItemData);
        
        return $data;
    }
}