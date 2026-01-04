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
 * 门店同步pos
 *
 * @category
 * @package
 * @author sunjing
 * @version $Id: Z
 */
class erpapi_store_request_shop extends erpapi_store_request_abstract
{

    /**
     * 商品同步pos
     *
     * @return void
     * @author
     **/
    public function shop_add($sdf)
    {
        $title = $this->__channelObj->wms['channel_name'].'门店同步';

        

        $params = $this->_format_shop_add_params($sdf);
       

        if (!$params) {
            return $this->error('参数为空,终止同步');
        }

        $method = $this->get_shop_add_apiname();
        if(!$method){
            return $this->error('方法为空');
        }

        $result = $this->call($method, $params, null, $title, 30, $sdf['store_bn']);


        return $result;

    }


    protected function _format_shop_add_params($sdf)
    {

        $params = array(
           
        );
            
       
        return $params;
    }

    protected function get_shop_add_apiname()
    {


    }

    
}
