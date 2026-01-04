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
 * CONFIG
 *
 * @category 
 * @package 
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_wms_openapi_cnss_config extends erpapi_wms_openapi_config
{
    private $__url_mapping = array(
        WMS_SALEORDER_CREATE        => '/rest/saleorder/SaleORder.do',
        WMS_SALEORDER_CANCEL        => '/rest/saleorder/sendOrderOperationMsg.do',
        WMS_ITEM_ADD                => '/rest/basicinfo/sendCommodity.do',
        WMS_ITEM_UPDATE             => '/rest/basicinfo/sendCommodity.do',
        WMS_INORDER_CREATE          => '/rest/purchase/sendPurchaseOrder.do',
        WMS_INORDER_CANCEL          => '/rest/stockRecallMsg/sendStockRecallMsg.do',
        WMS_OUTORDER_CREATE         => '/rest/outOrder/sendOutOrder.do',
        WMS_OUTORDER_CANCEL         => '/rest/stockRecallMsg/cancelPR.do',
        WMS_VENDORS_GET             => '/rest/basicinfo/sendVendor.do',
        WMS_RETURNORDER_CREATE      => '/rest/salereturn/sendSaleReturn.do',
        WMS_RETURNORDER_CANCEL      => '/rest/salereturn/cancelSaleReturn.do',
    );

    /**
     * 获取请求地址
     *
     * @param String $method 请求方法
     * @param Array $params 业务级请求参数
     * @param Boolean $realtime 同步|异步
     * @return void
     * @author 
     **/
    public function get_url($method, $params, $realtime){
        $url = $this->__channelObj->wms['adapter']['config']['api_url'];
        $url = rtrim($url,'/');

        $url .= $this->__url_mapping[$method];

        return $url;
    }


    /**
     * 定义应用参数
     *
     * @return void
     * @author 
     **/
    public function define_query_params(){
        $params  = array( 
            'label'=>'镜宴',
            'desc'=>'desc',
            // 'params' => array(
            //     'private_key' =>'私钥',
            //     'api_url'     => 'api地址',
            // ),
        );
        return $params;
    }

    public function format($params)
    {
        return json_encode($params);
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function get_query_params($method, $params)
    {
        $query_params = parent::get_query_params($method,$params);
        $query_params['headers'] = array(
            'Content-Type' => 'application/json',
        );

        return $query_params;
    }

    public function whitelist($apiname)
    {
        // $this->__whitelist = array_keys($this->__url_mapping);
        
        // return parent::whitelist($apiname);

        return $this->__url_mapping[$apiname] ? true : false;
    }
}