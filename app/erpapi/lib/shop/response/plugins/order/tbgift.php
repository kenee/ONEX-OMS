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
*
* @author chenping<chenping@shopex.cn>
* @version $Id: 2013-3-12 17:23Z
*/
class erpapi_shop_response_plugins_order_tbgift extends erpapi_shop_response_plugins_order_abstract
{

    /**
     * convert
     * @param erpapi_shop_response_abstract $platform platform
     * @return mixed 返回值
     */

    public function convert(erpapi_shop_response_abstract $platform)
    {
      $tbgift = array();

      if ('true' == app::get('ome')->getConf('ome.preprocess.tbgift')) {
          $tbgift['gift']     = $platform->_ordersdf['other_list'];
          $tbgift['order_id'] = null;
      }

      return $tbgift;
    }

    /**
     *
     * @return void
     * @author 
     **/
    public function postCreate($order_id,$tbgift)
    {
      kernel::single('ome_preprocess_tbgift')->save($order_id,$tbgift['gift']);
    }
}