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
 * 运单列表
 *
 * @categoryclassName
 * @package
 * @version $Id: Z
 */
class erpapi_ediws_request_refundinfo extends erpapi_ediws_request_abstract
{

   
    /**
     * 备件库运单列表
     * @param $appid
     * @param $secret
     * @return mixed
     */

    public function getlist($params)
    {
        
        $sdf = $this->getlist_format_params($params);
        $sdf['original_bn']='refundinfo_getlist';
        $title = '查询中小件备件库售后退货列表';
        if($sdf['outNo']){
            $sdf['original_bn']=$sdf['outNo'];
        }
        $result = $this->call('edi.request.refundinfo.getlist', $sdf, null, $title, 30, $sdf['original_bn']);

       
        unset($result['response']);

        
        return $result;
    }

   
    public function getlist_format_params($params){

        

        return $params;
    }
   

    /**
     * 查询中小件备件库发运详情-时尚
     * @param $appid
     * @param $secret
     * @return mixed
     */

    public function detail($params){
        $sdf = $this->detail_format_params($params);
        $sdf['original_bn'] = $sdf['refundId'];
        $title = '查询中小件备件库售后退货列表';

        $result = $this->call('edi.request.refundinfo.detail', $sdf, null, $title, 30, $sdf['original_bn']);


        unset($result['response']);


        return $result;
    }

    public function detail_format_params($params){

        
        return $params;
    }
}
