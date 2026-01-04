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
 * 全类型单据
 *
 * @author chenping@shopex.cn
 * @time 2017/12/11 14:04:37
 */
class erpapi_wms_request_bill extends erpapi_wms_request_abstract
{
    protected $_order_type = array(
        'all'          => '',
        'delivery'     => '',
        'stockin'      => '',
        'stockout'     => '',
        'purchasein'   => '',
        'purchaseout'  => '',
        'returnedin'   => '',
        'inventoryin'  => '',
        'inventoryout' => '',
      );

    /**
     * 查询出单列表
     * 
     * @return void
     * @author 
     */

    public function search_list($sdf)
    {
       $title = $this->__channelObj->channel['channel_name'].'单据列表查询';

       $apiname = $this->_search_list_apiname();

       if (!$apiname) return $this->error('接口暂不支持');

       $params = array(
            'order_type' => $this->_order_type[$sdf['iostock_type']] ? $this->_order_type[$sdf['iostock_type']] : '',
            'page_no'    => $sdf['page_no'] ? $sdf['page_no'] : 1,
            'page_size'  => $sdf['page_size'] ? $sdf['page_size'] : 50,
       );

       $rs = $this->__caller->call($apiname, $params, null, $title, 5);

       return $rs;
    }

    /**
     * 出库单接口名
     * 
     * @return void
     * @author 
     */
    protected function _search_list_apiname()
    {
        return null;
    }
}