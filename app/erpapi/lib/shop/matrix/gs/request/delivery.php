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
 * @author by mxc <maxiachen@shopex.cn> 
 * @describe 环球捕手
 */

class erpapi_shop_matrix_gs_request_delivery extends erpapi_shop_request_delivery{

	protected function get_confirm_params(&$sdf){
        $param = parent::get_confirm_params($sdf);
        $param['logistics_list'] = array(
        	array(
        		'company_code'	=>	$param['company_code'],
        		'company_name'	=>	$param['company_name'],
        		'logistics_no'	=>	$param['logistics_no'],
        	),
        );
        unset($param['company_code']);
        unset($param['company_name']);
        unset($param['logistics_no']);

        if (isset($sdf['delivery_bill_list']) && $sdf['delivery_bill_list']) {
        	$param['logistics_list'] = array_merge($param['logistics_list'],$sdf['delivery_bill_list']);
        }
        $param['logistics_list'] = json_encode($param['logistics_list']);

        return $param;
    }

}