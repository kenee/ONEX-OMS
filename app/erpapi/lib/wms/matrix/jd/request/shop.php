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
 * @author
 * @describe 店铺推送
 */

class erpapi_wms_matrix_jd_request_shop extends erpapi_wms_request_shop {

    protected function _format_create_params($params)
    {
        $sdf = parent::_format_create_params($params);
        $sdf['deptNo'] = app::get('wmsmgr')->getConf('department_no_'.$this->__channelObj->wms['channel_id']);
        $sdf['address'] = $sdf['province'] ? $sdf['province'] . $sdf['city'] . $sdf['district'] . $sdf['addr'] : '店铺详细地址';
        $sdf['afterSaleContacts'] = $sdf['contacts'] ? $sdf['contacts'] : '售后人';
        $sdf['afterSaleAddress'] = $sdf['address'];
        $sdf['afterSalePhone'] = $sdf['phone'] ? $sdf['phone'] : '14111111111';
        $sdf['spSourceNo'] = $params['shop_type']=='360buy' ? '1' : '6';
        return $sdf;
    }
}
