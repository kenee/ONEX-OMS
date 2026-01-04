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

#智选物流
class erpapi_channel_exrecommend extends erpapi_channel_abstract {

    /**
     * 初始化
     * @param mixed $channel_id ID
     * @param mixed $shop_id ID
     * @return mixed 返回值
     */
    public function init($channel_id,$shop_id){ 
        $obj_shop = app::get('ome')->model('shop');
        $shop_info = $obj_shop->getList('node_id',array("shop_id"=>$shop_id));
        #如果存在店铺，就一定是菜鸟智选,因为菜鸟智选和店铺关联
        if($shop_info){
            $this->__adapter = 'matrix';
            $this->__platform = 'taobao';
            //$this->exrecommend["to_node_id"] = $shop_info[0]["node_id"];
            $this->exrecommend["to_node_id"] = '1033373233';
        }else{
            $this->__adapter = 'matrix';
            $this->__platform = 'hqepay';
            $this->exrecommend["to_node_id"] = $shop_id;
        }  
        return true;
    }
}