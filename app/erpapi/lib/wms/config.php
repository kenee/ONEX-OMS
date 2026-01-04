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
 * CONFIG
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_wms_config extends erpapi_config
{
    /**
     * 应用级参数
     *
     * @param String $method 请求方法
     * @param Array $params 业务级请求参数
     * @return void
     * @author
     **/
    public function get_query_params($method, $params){
        $query_params = array(
            'app_id'       => 'ecos.ome',
            'method'       => $method,
            'date'         => date('Y-m-d H:i:s'),
            'format'       => 'json',
            'certi_id'     => base_certificate::certi_id(),
            'v'            => '1.1',
            'from_node_id' => base_shopnode::node_id('ome'),
            'to_node_id'   => $this->__channelObj->wms['node_id'],
            'to_api_v'     => $this->__channelObj->wms['api_version'],
            'node_type'    => $this->__channelObj->wms['node_type'],
        );

        //一盘货
        if (in_array($query_params['node_type'],array('yph'))){
            $query_params['to_node_id'] = $this->__channelObj->wms['addon']['node_id'];
        }
        return $query_params;
    }

     private $__global_whitelist = array(
        WMS_SALEORDER_CREATE,
        WMS_SALEORDER_CANCEL,
        WMS_SALEORDER_GET,
        WMS_ITEM_ADD,
        WMS_ITEM_UPDATE,
        WMS_RETURNORDER_CREATE,
        WMS_RETURNORDER_CANCEL,
        WMS_RETURNORDER_GET,
        WMS_TRANSFERORDER_CREATE,
        WMS_TRANSFERORDER_CANCEL,
        WMS_INORDER_CREATE,
        WMS_INORDER_CANCEL,
        WMS_INORDER_GET,
        WMS_OUTORDER_CREATE,
        WMS_OUTORDER_CANCEL,
        WMS_OUTORDER_GET,
        WMS_WAREHOUSE_LIST_GET,
        WMS_LOGISTICS_COMPANIES_GET,
        WMS_VENDORS_GET,
        WMS_ORDER_CANCEL,
        WMS_SHOP_CREATE,
        WMS_LOGISTICS_CREATE,
        WMS_COMBINE_CREATE,
        WMS_MAP_CREATE,
        WMS_CATEGORIES_FIRST_LEVEL_GET,
        WMS_CATEGORIES_SECODE_LEVEL_GET,
        WMS_CATEGORIES_THIRD_LEVEL_GET,
        WMS_SHOP_UPDATE,
        WMS_VENDORS_UPDATE,
        WMS_ITEM_INVENTORY_QUERY,
        WMS_TRADEORDER_CONSIGN,
        WMS_ITEM_GET,
        WMS_BMS_ORDER_CREATE,
        WMS_BMS_SNINFO_QUERY,
        WMS_BMS_STOCKIN_BILL_GET,
        WMS_BMS_STOCKOUT_BILL_GET,
        WMS_BMS_RETURN_BILL_GET,
        WMS_BMS_INVENTORY_PROFITLOSS_GET,
        WMS_BMS_BILL_QUERY,
        WMS_SALEORDER_CALLBACK,
       
    );
}
