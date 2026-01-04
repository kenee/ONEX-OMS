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
 * @author chenping@shopex.cn 2017/5/24
 * @describe 物流相关 无需授权
 */
class erpapi_noauth_matrix_taobao_request_logistics extends erpapi_noauth_request_logistics 
{
    /**
     * 判断地址可达不可达
     *
     * @return void
     * @author 
     **/

    public function addressReachable($sdf)
    {
        $title = '收货地址可不可达';

        if ($sdf['logistics_code'] == 'BEST') $sdf['logistics_code'] = 'HTKY';
        
        $params = array(
            // 'area_code'        => '',
            'address'          => $sdf['address'],
            'partner_ids'      => $sdf['logistics_code'],
            'service_type'     => '88',
            // 'source_area_code' => '',
        );

        $result = $this->__caller->call(NOAUTH_LOGISTICS_ADDRESS_REACHABLE,$params,null,$title,10,$sdf['orderBns']);

        if ($result['rsp'] == 'succ') {
            $result['data'] = @json_decode($result['data'],true);
        }

        return $result;
    }
}