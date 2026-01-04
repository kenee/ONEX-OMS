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
 * 店铺ITEM,RPC调用类
 * 
 * @author chenping<chenping@shopex.cn>
 */

class inventorydepth_service_shop_items {

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * 实时下载店铺商品
     *
     * @param Array $filter 搜索条件
     * @param String $shop_id 店铺ID
     * @param Int $offset 页码
     * @param Int $limit 每页条数
     * @return Array 
     */
    public function items_all_get($filter,$shop_id,&$errormsg,$offset=0,$limit=100){
        return kernel::single('inventorydepth_rpc_request_shop_items')->items_all_get($filter,$shop_id,$offset,$limit);
    }

    /**
     * 根据IID，实时下载店铺商品
     *
     * @param Array $iids 商品ID(不要超过限度20个)
     * @param String $shop_id 店铺ID 
     * @param Int $offset 页码
     * @param Int $limit 每页条数
     * @return Array 
     **/
    public function items_list_get($iids,$shop_id,&$errormsg)
    {
        return kernel::single('inventorydepth_rpc_request_shop_items')->items_list_get($iids,$shop_id);
    }

    /**
     * 获取单个商品明细
     *
     * @param Int $iid商品ID
     * @param String $shop_id 店铺ID 
     * @return void
     * @author 
     **/
    public function item_get($iid,$shop_id,&$errormsg)
    {
        return kernel::single('inventorydepth_rpc_request_shop_items')->item_get($iid,$shop_id);
    }
    
}
