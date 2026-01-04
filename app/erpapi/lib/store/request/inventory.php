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
 * 盘点单
 *
 * @category
 * @package
 * @author sunjing
 * @version $Id: Z
 */
class erpapi_store_request_inventory extends erpapi_store_request_abstract
{

    /**
     * 商品同步pos
     *
     * @return void
     * @author
     **/
    public function inventory_check($sdf)
    {
        $title = $this->__channelObj->wms['channel_name'].'盘点单审核';

        
      
        $params = $this->_format_check_params($sdf);
       

        if (!$params) {
            return $this->succ('未定义无需同步');
        }

        $method = $this->get_check_apiname();
        if(!$method){
            return $this->succ('未定义无需同步');
        }


        $result = $this->call($method, $params, null, $title, 30, $sdf['inventory_bn']);
        return $result;

    }


    protected function _format_check_params($sdf)
    {

        $params = array(
           
        );
            
       
        return $params;
    }

    protected function get_check_apiname()
    {


    }


    /**
     * 盘点拒绝
     *
     * @return void
     * @author
     **/
    public function inventory_cancel($sdf)
    {
        $title = $this->__channelObj->wms['channel_name'].'盘点单审核拒绝';

        
      
        $params = $this->_format_cancel_params($sdf);
       

        if (!$params) {
            return $this->succ('未定义无需同步');
        }

        $method = $this->get_cancel_apiname();
        if(!$method){
            return $this->succ('未定义无需同步');
        }

        $result = $this->call($method, $params, null, $title, 30, $sdf['inventory_bn']);
        return $result;

    }
  
}
