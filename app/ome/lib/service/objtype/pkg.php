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


class ome_service_objtype_pkg {
    /*
     * 处理object类型数据
     *
     * @param array $obj object数据
     * 
     * @return array $items 订单详情
     */
    public function process($obj){
        if ($obj['obj_type'] == 'pkg'){
            $item = app::get('ome')->model('order_items')->dump(array('obj_id'=>$obj['obj_id'],'order_id'=>$obj['order_id'],'item_type'=>'pkg'));
            if ($item['delete']=='true'){
                return array();
            }
            $order = app::get('ome')->model('orders')->dump($obj['order_id'],'order_bn');
            
            $items['order_bn']  = $order['order_bn'];
            $items['bn']        = $obj['bn'];
            $items['name']      = $obj['name'];
            $items['unit']      = $obj['unit']?$obj['unit']:'-';
            $items['spec_info'] = $obj['spec_info']?$obj['spec_info']:'-';
            $items['nums']      = $obj['quantity'];
            $items['price']     = $obj['price'];
            $items['sale_price'] = $obj['sale_price'];
            $items['shop_goods_id'] = $obj['shop_goods_id'];
            
            return array($items);
        }
        return array();
    }
}