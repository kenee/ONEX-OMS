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


class ome_order_products{
    /**
     * 获取订单编辑时每种objtype的显示内容定义
     * @access public
     * @param int $reship_id 退货单ID
     */
    public function get_view_list(){
        $conf_list = array(
            'pkg'       => $this->view_pkg(),
            'gift'      => $this->view_gift(),
            'goods'     => $this->view_goods(),
            'giftpackage'   => $this->view_giftpackage(),
            'lkb'   => $this->view_lkb(),
            'pko'   => $this->view_pko(),
        );
        return $conf_list;
    }

    public function view_pkg(){
        $config = array(
           'app' => 'ome',
           'html' => 'admin/order/products/pkg_view.html',
        );
        return $config;
    }
    
    public function view_gift(){
        $config = array(
           'app' => 'ome',
           'html' => 'admin/order/products/gift_view.html',
        );
        return $config;
    }
    
    /**
     * view_goods
     * @return mixed 返回值
     */
    public function view_goods(){
        $config = array(
           'app' => 'ome',
           'html' => 'admin/order/products/goods_view.html',
        );
        return $config;
    }
    
    /**
     * view_giftpackage
     * @return mixed 返回值
     */
    public function view_giftpackage(){
        $config = array(
           'app' => 'ome',
           'html' => 'admin/order/products/giftpackage_view.html',
        );
        return $config;
    }
    
    /**
     * view_lkb
     * @return mixed 返回值
     */
    public function view_lkb(){
        $config = array(
           'app' => 'ome',
           'html' => 'admin/order/products/lkb_view.html',
        );
        return $config;
    }
    
    /**
     * view_pko
     * @return mixed 返回值
     */
    public function view_pko(){
        $config = array(
                'app' => 'ome',
                'html' => 'admin/order/products/pko_view.html',
        );
        return $config;
    }
    
}