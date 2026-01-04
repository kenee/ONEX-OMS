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

class omeanalysts_shop{

    /**
     * 根据平台类型返回对应店铺id
     * @return 
     */
    public function getShopList(){
        $shopModel = app::get('ome')->model('shop');
        $shopList = $shopModel->getList('shop_id,shop_type');

        $shops = array();
        foreach($shopList as $shop){
            $shops[$shop['shop_type']][] = $shop['shop_id'];
        }

        return $shops;
    }

    public function getShopDetail($shop_id){
        
        static $shop;
        if ($shop[$shop_id]) return $shop[$shop_id];
        $shopModel = app::get('ome')->model('shop');
        $shop_detail = $shopModel->dump(array('shop_id'=>$shop_id),'shop_type');

        $shoptype = ome_shop_type::get_shop_type();

        if($shop_detail['shop_type']){
            return $shoptype[$shop_detail['shop_type']];
        }else{
            return '-';
        }
    }

    /**
     * 获取ShopType
     * @param mixed $shop_type shop_type
     * @return mixed 返回结果
     */
    public function getShopType($shop_type){
        $shoptype = ome_shop_type::get_shop_type();
        return $shoptype[$shop_type];
    }
}


?>