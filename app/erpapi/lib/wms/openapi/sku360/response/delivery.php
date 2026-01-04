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
 * WMS 发货单
 *
 * @category
 * @package
 * @author yaokangming<yaokangming@shopex.cn>
 * @version $Id: Z
 */
class erpapi_wms_openapi_sku360_response_delivery  extends erpapi_wms_response_delivery
{
    /**
     * status_update
     * @param mixed $params 参数
     * @return mixed 返回值
     */

    public function status_update($params){
        $sys_logistics = kernel::single('wmsmgr_func')->getlogiCode($this->__channelObj->wms['channel_id'],$params['logistics']);
        $params['logistics'] = $sys_logistics ? $sys_logistics : $params['logistics'];

        return parent::status_update($params);
    }
}
