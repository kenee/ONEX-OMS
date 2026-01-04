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
 * 调整单
 *
 * @category
 * @package
 * @author sunjing
 * @version $Id: Z
 */
class erpapi_store_request_adjust extends erpapi_store_request_abstract
{

    /**
     * 调整单创建
     *
     * @return void
     * @author
     **/
    public function adjust_create($sdf)
    {
        $title = $this->__channelObj->wms['channel_name'].'调整单创建';

        
      
        $params = $this->_format_create_params($sdf);
       

        if (!$params) {
            return $this->succ('未定义无需同步');
        }

        $method = $this->get_create_apiname();
        if(!$method){
            return $this->succ('未定义无需同步');
        }


        $result = $this->call($method, $params, null, $title, 30, $sdf['diff_bn']);
        return $result;

    }

    protected function get_create_apiname()
    {
        return '';
    }

    protected function _format_create_params($sdf)
    {
    }
   
    /**
     * 调整单审核
     *
     * @return void
     * @author
     **/

    public function adjust_check($sdf){

    }

    /**
     * 调整单取消
     *
     * @return void
     * @author
     **/
    public function adjust_cancel($sdf){
        
    }
}
