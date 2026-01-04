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
* 订单插件抽象类
*
* @category 
* @package 
* @author chenping<chenping@shopex.cn>
* @version $Id: abstract.php 2013-3-12 17:23Z
*/
abstract class erpapi_shop_response_plugins_order_abstract
{
  public function convert(erpapi_shop_response_abstract $platform)
  {
    return array();
  }

    /**
     * 订单保存之后处理
     *
     * @return void
     * @author 
     **/
    public function postCreate($order_id,$params)
    {}

    /**
     * 订单更新之后处理
     *
     * @return void
     * @author 
     **/
    public function postUpdate($order_id,$params)
    {}

    final public function getShop($shop_id)
    {
        static $shops;

        if ($shops[$shop_id]) return $shops[$shop_id];

        $shop = app::get('ome')->model('shop')->getList('*',array('shop_id'=>$shop_id));

        $shops[$shop_id] = $shop[0];

        return $shops[$shop_id];
    }

    final public function getOrder($order_id)
    {
        static $orders;

        if ($orders[$order_id]) return $orders[$order_id];

        $order = app::get('ome')->model('orders')->getList('*',array('order_id'=>$order_id));

        $orders[$order_id] = $order[0];

        return $orders[$order_id];
    }

    final public function getOrderObjects($order_id)
    {
        static $order_objects;

        if ($order_objects[$order_id]) return $order_objects[$order_id];

        $order_objects[$order_id] = app::get('ome')->model('order_objects')->getList('*',array('order_id'=>$order_id));
        
        return $order_objects[$order_id];
    }

    final public function getOrderItems($order_id)
    {
        static $order_items;

        if ($order_items[$order_id]) return $order_items[$order_id];

        $order_items[$order_id] = app::get('ome')->model('order_items')->getList('*',array('order_id'=>$order_id));

        return $order_items[$order_id];
    }
    
    
    final public function getOrderExtends($order_id)
    {
        static $order_extend;
        
        if ($order_extend[$order_id]) return $order_extend[$order_id];
        
        $order_extend[$order_id] = app::get('ome')->model('order_extend')->db_dump(array('order_id'=>$order_id),'*');
        
        return $order_extend[$order_id];
    }
    
    
    /**
     * 比较数组值
     *
     * @return void
     * @author 
     **/
    public function comp_array_value($a,$b)
    {
        if ($a == $b) {
            return 0;
        }

        return $a > $b ? 1 : -1 ;
    }

    public function filter_null($var)
    {
        return !is_null($var) && $var !== '';
    }
}