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
 * @author chenping@shopex.cn
 * @time 2017/12/8 17:59:17
 * @describe BMS出库单
 */
class erpapi_wms_matrix_bms_request_stockout extends erpapi_wms_request_stockout
{
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

    /**
     * 出库单列表参数
     * 
     * @return void
     * @author 
     */
    protected function _search_list_params($sdf)
    {
        $order_type = array('stockout' => '903');

        $params = parent::_search_list_params($sdf);
        $params['order_type'] = $order_type[$sdf['iostock_type']];

        return $params;
    }

    # 出库单创建
    public function create($sdf){
        return $this->error('BMS不支持出库单创建');
    } 

    public function cancel($sdf){
        return $this->succ('允许直接取消');
    }

    # 出库查询
    public function search($sdf)
    {
        return $this->error('BMS不支持出库单查询');
    }
}