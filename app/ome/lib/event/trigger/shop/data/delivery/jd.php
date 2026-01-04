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
 * 获取数据
 *
 * @category 
 * @package 
 * @author sunjing@shopex.cn
 * @version $Id: Z
 */
class ome_event_trigger_shop_data_delivery_jd extends ome_event_trigger_shop_data_delivery_common
{
    public function get_sdf($delivery_id)
    {
        $this->__sdf = parent::get_sdf($delivery_id);
        $this->__sdf['branch'] = $this->_get_branch($this->__deliverys[$delivery_id]['branch_id']);
        return $this->__sdf;
    }

	/**
     * JD 
     *
     * @return void
     * @author 
     **/
    public function get_add_delivery_sdf($delivery_id)
    {
        return $this->get_sdf($delivery_id);
    }
	
}