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
 * 获取数据
 *
 * @category 
 * @package 
 * @author by mxc <maxiachen@shopex.cn> 
 * @version 
 */
class ome_event_trigger_shop_data_delivery_gs extends ome_event_trigger_shop_data_delivery_common
{
    public function get_sdf($delivery_id)
    {
        $this->__sdf = parent::get_sdf($delivery_id);
        $delivery_bill_list = array();
        if ($this->__sdf) {
        	$delivery_bill_detail = $this->_get_delivery_bill_detail($delivery_id);
        	foreach ($delivery_bill_detail as $d_b_detail) {
        		if ($d_b_detail['logi_no']) {
        			$delivery_bill_list[] = array(
        				'company_code'	=>	$this->__sdf['logi_type'],
		        		'company_name'	=>	$this->__sdf['logi_name'],
		        		'logistics_no'	=>	$d_b_detail['logi_no'],
        			);
        		}
        	}
            $this->__sdf['delivery_bill_list'] = $delivery_bill_list;
        }

        return $this->__sdf;
    }
}