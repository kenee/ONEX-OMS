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
 * WMS 商品
 *
 * @category
 * @package
 * @author xueding@shopex.cn
 */
class erpapi_wms_response_goods extends erpapi_wms_response_abstract
{
    protected $unitConversion = 1000;
    
    /**
     * wms.goods.status_update
     *
     **/
    public function status_update($params)
    {
        // 参数校验
        $this->__apilog['title']       = $this->__channelObj->wms['channel_name'] . '云交易商品信息变更MQ' . $params['sku_id'];
        $this->__apilog['original_bn'] = $params['sku_id'];
        
        $data = array(
            'sku_id'       => trim($params['sku_id']),
            'channel_id'    => trim($params['channel_id']),
            'type'         => trim($params['type']),
            'wms_id'       => $this->__channelObj->wms['channel_id'],
        );
        return $data;
    }
}
