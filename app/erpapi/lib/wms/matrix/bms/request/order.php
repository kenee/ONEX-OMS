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
 * /BMS sn码查询
 *
 * @author sunjing@shopex.cn
 * @time 2017/12/7 11:48:33
 */
class erpapi_wms_matrix_bms_request_order extends erpapi_wms_request_order
{
  
    /**
     * query
     * @param mixed $sdf sdf
     * @return mixed 返回值
     */

    public function query($sdf){
        $order_bn = $sdf['order_bn'];

        $title = $this->__channelObj->wms['channel_name'] . 'SN码查询';

        $params = $this->_format_query_params($sdf);

        $rs = $this->__caller->call(WMS_BMS_SNINFO_QUERY, $params, null, $title, 10, $order_bn);

        if($rs['rsp'] == 'succ') {
       
            
        }
        return $rs;
    }

   
    protected function _format_query_params($sdf){
        $params = array(

            'tid'               =>  $sdf['order_bn'],
            'order_code_type'   =>  '10',
            //'page_index'        =>  '50',

        );
        
        return $params;
    }
}