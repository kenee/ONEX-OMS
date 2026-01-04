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
 * [拆单]保存淘宝平台的原始属性值
 *
 * @access public
 * @author wangbiao<wangbiao@shopex.cn>
 * @version $Id: consign.php 2016-10-20
 */
class erpapi_shop_response_plugins_order_tboid extends erpapi_shop_response_plugins_order_abstract
{
    /**
     * convert
     * @param erpapi_shop_response_abstract $platform platform
     * @return mixed 返回值
     */

    public function convert(erpapi_shop_response_abstract $platform)
    {
        $tbsdf    = array();
        
        //[拆单]保存淘宝平台的原始属性值
        if($platform->_ordersdf['shop_type'] == 'taobao' && !empty($platform->_ordersdf['order_objects']))
        {
            $tbsdf['order_id']    = $platform->_ordersdf['order_id'];
            $tbsdf['order_bn']    = $platform->_ordersdf['order_bn'];
            $tbsdf['shop_type']   = $platform->_ordersdf['shop_type'];
            $tbsdf['order_objects']    = $platform->_ordersdf['order_objects'];
        }
        
        return $tbsdf;
    }
    
    /**
     * 订单完成后处理
     *
     * @return void
     * @author
     **/
    public function postCreate($order_id, $tbsdf)
    {
        //执行保存属性值
        kernel::single('ome_order_split')->hold_order_delivery($tbsdf);
    }
}