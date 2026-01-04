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
 * 出库单推送
 *
 * @category 
 * @package 
 * @author sunjing
 * @version $Id: Z
 */
class erpapi_store_request_stockout extends erpapi_store_request_abstract
{
    

    /**
     * 出库单创建
     *
     * @return void
     * @author
     **/
    public function stockout_create($sdf){
        $stockout_bn = $sdf['io_bn'];
       
        //是否取消状态
        $iscancel = kernel::single('console_service_commonstock')->iscancel($stockout_bn, $is_vop);
        if ($iscancel) {
            return $this->succ('出库单已取消,终止同步');
        }

        $title = $this->__channelObj->wms['channel_name'] . '出库单添加';
        
        $params = $this->_format_stockout_create_params($sdf);
       

        if(!$params){
            return $this->succ('缺少请求参数');
        }
        $method = $this->get_stockout_create_apiname($sdf['bill_type']);

        if(!$method){
            return $this->succ('缺少请求method');
        }

       $result= $this->call($method, $params, $callback, $title, 10, $stockout_bn);

       if($result['succ'] == 'succ'){
            if($result['data']['docNo']){
                $result['data']['wms_order_code'] = $result['data']['docNo'];
            }
       }
       return $result;
    }

   

    protected function _format_stockout_create_params($sdf)
    {
       
    }


    protected function get_stockout_create_apiname($bill_type){

    }
    /**
     * 出库单取消
     *
     * @return void  
     * @author
     **/
    public function stockout_cancel($sdf){
        $stockout_bn = $sdf['io_bn'];

        $title = $this->__channelObj->wms['channel_name'] . '出库单取消';

        $params = $this->_format_stockout_cancel_params($sdf);

        return $this->__caller->call(WMS_OUTORDER_CANCEL, $params, null, $title, 10, $stockout_bn);

    }

    protected function _format_stockout_cancel_params($sdf)
    {
        
    }

    
}