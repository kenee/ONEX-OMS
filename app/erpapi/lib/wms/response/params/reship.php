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
 * WMS 退货参数验证
 *
 * @category 
 * @package 
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_wms_response_params_reship extends erpapi_wms_response_params_abstract
{
    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function status_update()
    {
        $params = array(
            'reship_bn' => array('required'=>'true','type'=>'string','errmsg'=>'退货单号必填'),
            'status'=>array('type'=>'enum','value'=>array('FINISH','PARTIN','CLOSE','FAILED','DENY','ACCEPT')),
        );

        return $params;
    }
    
    public function add_complete()
    {
        $params = array(
            'reship_bn' => array('required'=>'true','type'=>'string','errmsg'=>'退货单号必填'),
            'items' => array('required'=>'true','type'=>'array','errmsg'=>'明细缺少'),
        );

        return $params;
    }
    
    /**
     * 京东云交易订单退款MQ消息
     * @todo：消息主题：ct_order_refund
     *
     * @param array $params
     * @return array
     */
    public function service_refund()
    {
        $params = array();
        
        return $params;
    }
}