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
* 到付
*
* @author chenping<chenping@shopex.cn>
* @version $Id: 2013-3-12 17:23Z
*/
class erpapi_shop_response_plugins_order_cod extends erpapi_shop_response_plugins_order_abstract
{

  public function convert(erpapi_shop_response_abstract $platform)
  {
      $codsdf = array();

      if('true' == $platform->_ordersdf['shipping']['is_cod']){
          if ( in_array($platform->__channelObj->channel['node_type'], array('vjia','360buy','dangdang','yihaodian')) ) {
              foreach((array) $platform->_ordersdf['other_list'] as $val){
                  if($val['type']=='unpaid'){
                      $unpaidprice = $val['unpaidprice'];
                      break;
                  }
              }

              $codsdf['receivable'] = (isset($unpaidprice)) ? $unpaidprice : ($platform->_ordersdf['total_amount'] - $platform->_ordersdf['payed']);
          }else{
              $codsdf['receivable'] = $platform->_ordersdf['total_amount'];
          }
          $codsdf['order_id'] = null;
      }

      return $codsdf; 
  }

    /**
     * 到付保存
     *
     * @return void
     * @author 
     **/
    public function postCreate($order_id,$codinfo)
    {
        $orderExtendObj = app::get('ome')->model('order_extend'); 

        $codinfo['order_id'] = $order_id;

        $orderExtendObj->save($codinfo);
    }

  /**
   * 到付更新
   *
   * @param Array 
   * @return void
   * @author 
   **/
  public function postUpdate($order_id,$codinfo)
  {
    $orderExtendObj = app::get('ome')->model('order_extend'); 

    $codinfo['order_id'] = $order_id;

    $orderExtendObj->save($codinfo);
  }
}