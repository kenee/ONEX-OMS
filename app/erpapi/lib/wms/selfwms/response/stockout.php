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
 * 出库单
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_wms_selfwms_response_stockout extends erpapi_wms_response_stockout
{
    /**
     * status_update
     * @param mixed $params 参数
     * @return mixed 返回值
     */

    public function status_update($params){
        $this->__apilog['title']       = $this->__channelObj->wms['channel_name'].'出库单';
        $this->__apilog['original_bn'] = $params['io_bn'];

        return $params;
    }
}
