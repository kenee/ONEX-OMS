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
* 订单备注旗标
*
* @author chenping<chenping@shopex.cn>
* @version $Id: marktype.php 2013-3-12 17:23Z
*/
class erpapi_shop_response_components_order_marktype extends erpapi_shop_response_components_order_abstract
{
    const _APP_NAME = 'ome';

    /**
     * 订单格式转换
     *
     * @return void
     * @author 
     **/
    public function convert()
    {
        if ($this->_platform->_ordersdf['mark_type']) {
            $this->_platform->_newOrder['mark_type'] = $this->_platform->_ordersdf['mark_type'];
        }
    }
    
    /**
     * 更新订单旗标
     *
     * @return void
     * @author 
     **/
    public function update()
    {
        if ($this->_platform->_ordersdf['mark_type'] && $this->_platform->_ordersdf['mark_type'] != $this->_platform->_tgOrder['mark_type']) {
            $this->_platform->_newOrder['mark_type'] = $this->_platform->_ordersdf['mark_type'];
        }
    }
}