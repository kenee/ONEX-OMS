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


class ome_order_confirm{
    /**
     * 获取订单编辑时每种objtype的显示内容定义
     * @access public
     * @param int $reship_id 退货单ID
     */
    public function get_view_list(){
        $conf_list = array(
            'goods'     => $this->view_goods(),
            'pkg'       => $this->view_pkg(),
            'gift'      => $this->view_gift(),
            'giftpackage'   => $this->view_giftpackage(),
        );
        return $conf_list;
    }

    public function view_pkg(){
        $config = array(
           'app' => 'ome',
           'html' => 'admin/order/confirm/pkg_confirm.html',
           'js_process' => 'pkg_doprocess()',
           'js_count' => 'pkg_getSendcount(index)',
        );
        return $config;
    }
    public function view_gift(){
        $config = array(
           'app' => 'ome',
           'html' => 'admin/order/confirm/gift_confirm.html',
           'js_process' => 'gift_doprocess()',
           'js_count' => 'gift_getSendcount(index)',
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
           'html' => 'admin/order/confirm/goods_confirm.html',
           'js_process' => 'goods_doprocess()',
           'js_count' => 'goods_getSendcount(index)',
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
           'html' => 'admin/order/confirm/giftpackage_confirm.html',
           'js_process' => 'giftpackage_doprocess()',
           'js_count' => 'giftpackage_getSendcount(index)',
        );
        return $config;
    }
}