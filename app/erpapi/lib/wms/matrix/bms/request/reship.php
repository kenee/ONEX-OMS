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
 * @describe BMS退货单
 */
class erpapi_wms_matrix_bms_request_reship extends erpapi_wms_request_reship
{
    /**
     * 退换货接口名
     * 
     * @return void
     * @author 
     */

    protected function _search_list_apiname()
    {
        return WMS_BMS_BILL_QUERY;
    }

    /**
     * 退换货列表参数
     * 
     * @return void
     * @author 
     */
    protected function _search_list_params($sdf)
    {
        $order_type = array('returnedin'=>'501','exchangedin' => '502');

        $params = parent::_search_list_params($sdf);
        $params['order_type'] = $order_type[$sdf['iostock_type']];

        return $params;
    }

    #退货单创建
    public function create($sdf){
        return $this->error('BMS不支持退货单创建');
    }

    public function cancel($sdf){
        return $this->succ('允许直接取消');
    }

    # 退货单查询
    public function search($sdf)
    {
        return $this->error('BMS不支持退货单查询');
    }
}