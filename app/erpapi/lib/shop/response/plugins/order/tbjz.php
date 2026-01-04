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
*
* @author chenping<chenping@shopex.cn>
* @version $Id: 2013-3-12 17:23Z
*/
class erpapi_shop_response_plugins_order_tbjz extends erpapi_shop_response_plugins_order_abstract
{

    /**
     * convert
     * @param erpapi_shop_response_abstract $platform platform
     * @return mixed 返回值
     */

    public function convert(erpapi_shop_response_abstract $platform)
    {
      $jzorder_list = array();

      foreach ((array)$platform->_ordersdf['other_list'] as $other ) {
          if ($other['type'] == 'category') {
              $jzorder_list[] = array(
                'cid' => $other['cid'],
                'oid' => $other['oid'],
              );
          }
      }
              
      return $jzorder_list;
    }

    /**
     *
     * @return void
     * @author 
     **/
    public function postCreate($order_id,$jzorder_list)
    {
        $jzObj = app::get('ome')->model('tbjz_orders');


        foreach ($jzorder_list as $key=>$order ) {
          $jzorder_list[$key]['order_id'] = $order_id;
        }

        $sql = ome_func::get_insert_sql($jzObj,$jzorder_list);
        kernel::database()->exec($sql);
    }
}