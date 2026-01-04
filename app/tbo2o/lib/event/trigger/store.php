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
 * 淘宝o2o门店接口事件类
 * 20160825
 * @author wangjianjun<wangjianjun@shopex.cn>
 * @version 0.1
 */
class tbo2o_event_trigger_store{

    /**
     * 门店新增接口
     * @param string $id 淘宝o2o配置主键id
     * @param array $data 门店新增通知数据信息
     */
    public function storeCreate(&$data){
        return kernel::single('erpapi_router_request')->set('tbo2o',true)->store_create($data);
    }
    
    /**
     * 查询门店主营类目信息接口
     * @param string $id 淘宝o2o配置主键id
     * @param array $data 查询门店主营类目信息通知数据信息
     */
    public function storecategoryGet(&$data){
        return kernel::single('erpapi_router_request')->set('tbo2o',true)->store_storecategory_get($data);
    }
    
    /**
     * 更新门店信息接口
     * @param string $id 淘宝o2o配置主键id
     * @param array $data 更新门店信息通知数据信息
     */
    public function storeUpdate(&$data){
        return kernel::single('erpapi_router_request')->set('tbo2o',true)->store_update($data);
    }
    
    /**
     * 删除门店信息接口
     * @param string $id 淘宝o2o配置主键id
     * @param array $data 删除门店信息通知数据信息
     */
    public function storeDelete(&$data){
        return kernel::single('erpapi_router_request')->set('tbo2o',true)->store_delete($data);
    }
    
    /**
     * 查询门店信息接口
     * @param string $id 淘宝o2o配置主键id
     * @param array $data 查询门店信息通知数据信息
     */
    public function storeQuery(&$data){
        return kernel::single('erpapi_router_request')->set('tbo2o',true)->store_query($data);
    }
    
    /**
     * 新建/删除商品和门店的绑定关系
     * @param string $id 淘宝o2o配置主键id
     * @param array $data 新建/删除商品和门店的绑定关系通知数据信息
     */
    public function storeItemstoreBanding(&$data){
        return kernel::single('erpapi_router_request')->set('tbo2o',true)->store_itemstore_banding($data);
    }
    
    /**
     * 查询线上商品所关联的门店列表
     * @param string $id 淘宝o2o配置主键id
     * @param array $data 查询线上商品所关联的门店列表通知数据信息
     */
    public function storeItemstoreQuery(&$data){
        return kernel::single('erpapi_router_request')->set('tbo2o',true)->store_itemstore_query($data);
    }
    
    /**
     * 查询门店所关联的线上商品列表
     * @param string $id 淘宝o2o配置主键id
     * @param array $data 查询门店所关联的线上商品列表通知数据信息
     */
    public function storeStoreitemQuery(&$data){
        return kernel::single('erpapi_router_request')->set('tbo2o',true)->store_storeitem_query($data);
    }
    
    /**
     * [新增]推送后端商品至淘宝
     * 
     * @param string $id 淘宝o2o配置主键id
     * @param array $data 维护宝贝货品映射关系通知数据信息
     */
    public function storeScitemAdd(&$data){
        return kernel::single('erpapi_router_request')->set('tbo2o',true)->store_scitem_add($data);
    }
    
    /**
     * [更新]修改的后端商品信息至淘宝
     * 
     * @param string $id 淘宝o2o配置主键id
     * @param array $data 维护宝贝货品映射关系通知数据信息
     */
    public function storeScitemUpdate(&$data){
        return kernel::single('erpapi_router_request')->set('tbo2o',true)->store_scitem_update($data);
    }
    
    /**
     * [查询]下载淘宝平台上的后端商品
     *
     * @param string $id 淘宝o2o配置主键id
     * @param array $data 维护宝贝货品映射关系通知数据信息
     */
    public function storeScitemQuery(&$data){
        return kernel::single('erpapi_router_request')->set('tbo2o',true)->store_scitem_query($data);
    }
    
    /**
     * [新增]宝贝和货品的关联
     * 
     * @param string $id 淘宝o2o配置主键id
     * @param array $data 宝贝和货品的关联通知数据信息
     */
    public function storeScitemMapAdd(&$data){
        return kernel::single('erpapi_router_request')->set('tbo2o',true)->store_scitem_map_add($data);
    }
    
    /**
     * [解绑]指定用户的商品与后端商品的映射关系
     * 
     * @param string $id 淘宝o2o配置主键id
     * @param array $data 宝贝和货品的关联通知数据信息
     */
    public function storeScitemMapDelete(&$data){
        return kernel::single('erpapi_router_request')->set('tbo2o',true)->store_scitem_map_delete($data);
    }
    
    /**
     * 全量更新电商仓或门店库存
     * @param string $id 门店服务端$server_id
     * @param array $data 全量更新电商仓或门店库存通知数据信息
     */
    public function storeinventoryIteminitial(&$data){
        return kernel::single('erpapi_router_request')->set('tbo2o',true)->store_inventory_iteminitial($data);
    }
    
    /**
     * 增量更新门店或电商仓库存
     * @param string $id 门店服务端$server_id
     * @param array $data 全量更新电商仓或门店库存通知数据信息
     */
    public function storeinventoryItemupdate(&$data){
        return kernel::single('erpapi_router_request')->set('tbo2o',true)->store_inventory_itemupdate($data);
    }
    
    //response测试通路
//     public function storeSync($id, $data, $sync = false){
//         $result = kernel::single('erpapi_router_response')->set_channel_id($id)->set_api_name('tbo2o.store.sync')->dispatch($data);
//     }
    
}