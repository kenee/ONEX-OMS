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
 * 出库单推送
 *
 * @category 
 * @package 
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_wms_matrix_arvato_request_stockout extends erpapi_wms_request_stockout
{
    protected function _format_stockout_create_params($sdf)
    {
        $params = parent::_format_stockout_create_params($sdf);

        $params['logical_code'] = $this->get_warehouse_code($this->__channelObj->wms['channel_id'],$sdf['branch_bn']);

        return $params;
    }

    protected function _format_stockout_cancel_params($sdf)
    {
        $params = parent::_format_stockout_cancel_params($sdf);
    
        $params['logical_code'] = $this->get_warehouse_code($this->__channelObj->wms['channel_id'],$sdf['branch_bn']);

        return $params;
    }
}