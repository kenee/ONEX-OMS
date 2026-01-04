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
 * 主库退货单查询
 *
 * @categoryclassName
 * @package
 * @version $Id: Z
 */
class erpapi_ediws_request_reship extends erpapi_ediws_request_abstract
{

   
    /**
     * 主库退货单查询
     * @param $appid
     * @param $secret
     * @return mixed
     */

    public function query($params)
    {
        
        $sdf = $this->query_format_params($params);

        $title = '主库退货单查询';

        $result = $this->call('edi.request.reship.query', $sdf, null, $title, 30, $sdf['original_bn']);

        
        unset($result['response']);

        
        return $result;
    }

   
    public function query_format_params($params){

        

        return $params;
    }
   

}
