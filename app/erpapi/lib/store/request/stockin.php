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
 * pos入库单
 *
 * @category 
 * @package 
 * @author sunjing
 * @version $Id: Z
 */
class erpapi_store_request_stockin extends erpapi_store_request_abstract
{
    
    /**
     * 入库单创建
     *
     * @return void
     * @author
     **/
    public function stockin_create($sdf){
        $stockin_bn = $sdf['io_bn'];

        $iscancel = kernel::single('console_service_commonstock')->iscancel($stockin_bn);
        if ($iscancel) {
            return $this->succ('入库单已取消,终止同步');
        }

        $title = $this->__channelObj->wms['channel_name'].'入库单添加';

        $params = $this->_format_stockin_create_params($sdf);
        if (!$params) {
            return $this->error('参数为空,终止同步');
        }
        $method = $this->get_stockin_create_apiname($sdf['bill_type']);
        $result = $this->call($method, $params, $callback, $title, 10, $stockin_bn);
        if($result['succ'] == 'succ'){
            if($result['data']['docNo']){
                $result['data']['wms_order_code'] = $result['data']['docNo'];
            }
       }
        return $result;
        
    }

    

    protected function get_stockin_create_apiname($bill_type)
    {
        return '';
    }

    protected function _format_stockin_create_params($sdf)
    {
        

       return $params;
    }

   
}