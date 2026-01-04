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
class erpapi_wms_matrix_bms_request_bill extends erpapi_wms_request_bill
{
    protected $_order_type = array(
        'all'          => '',
        'delivery'     => '',
        'stockin'      => '904',
        'stockout'     => '903',
        'purchasein'   => '601',
        'purchaseout'  => '901',
        'returnedin'   => '501',
        'inventoryin'  => '702',
        'inventoryout' => '701',
      );

    /**
     * 出库单接口名
     * 
     * @return void
     * @author 
     */

    protected function _search_list_apiname()
    {
        return WMS_BMS_BILL_QUERY;
    }
}