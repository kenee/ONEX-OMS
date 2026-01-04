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
 * 华为商城平台对接
 * 
 * @author wangbiao@shopex.cn
 * @version $Id: Z
 */
class erpapi_shop_matrix_huawei_request_delivery extends erpapi_shop_request_delivery
{
    protected function get_confirm_params($sdf)
    {
        //组织参数
        $param = parent::get_confirm_params($sdf);
        
        //items
        $packages = array();
        if($sdf['is_split'] == 1 && $sdf['delivery_items']){
            foreach ($sdf['delivery_items'] as $key => $val)
            {
                $order_oid = $val['oid'];
                $logi_no = $val['logi_no'];
                
                $packages[$logi_no] = array(
                        'logistics_no' => $val['logi_no'],
                        'company_code' => $val['logi_type'],
                        'company_name' => $val['logi_name'],
                );
            }
            
            $packages = array_values($packages);
        }else{
            $packages[] = array(
                    'logistics_no' => $sdf['logi_no'],
                    'company_code' => $sdf['logi_type'],
                    'company_name' => $sdf['logi_name'],
            );
        }
        
        $param['packages'] = json_encode($packages);
        
        return $param;
    }
}