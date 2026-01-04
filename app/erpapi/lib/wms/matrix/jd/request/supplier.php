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
 * @describe 供应商推送
 */

class erpapi_wms_matrix_jd_request_supplier extends erpapi_wms_request_supplier
{
    protected $failMsgList = array('新增失败：记录已存在！');

    protected function _format_supplier_create_params($sdf)
    {
        $params = parent::_format_supplier_create_params($sdf);
        $params['deptNo'] = app::get('wms')->getConf('wms_storage_division_code_'.$this->__channelObj->channel['channel_id']);
        $params['vendor'] = $sdf['bn'];
        $params['contacts'] = $sdf['contacter'] ? $sdf['contacter'] : '供应商联系人';
        $params['phone_num'] = $sdf['telphone'] ? $sdf['telphone'] : '14111111111';
        $params['fax'] = $sdf['fax'];
        $params['country'] = $sdf['district'];
        return $params;
    }
}
