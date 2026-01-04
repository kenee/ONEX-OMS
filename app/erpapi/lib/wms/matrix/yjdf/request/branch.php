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
 * 仓库
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_wms_matrix_yjdf_request_branch extends erpapi_wms_request_branch
{

    /**
     * branch_getAreaList
     * @param mixed $sdf sdf
     * @return mixed 返回值
     */

    public function branch_getAreaList($sdf)
    {

        $title  = $this->__channelObj->wms['channel_name'] . '获取地址库列表';
        $params = array(
            'warehouse_code' => '123456',
            'parent_id'      => $sdf['parent_id'],

        );

        $rsp = $this->__caller->call(WMS_AREA_ADDRESS_GET, $params, null, $title, 10);

        $result            = array();
        $result['rsp']     = $rsp['rsp'];
        $result['err_msg'] = $rsp['err_msg'];
        $result['msg_id']  = $rsp['msg_id'];
        $result['res']     = $rsp['res'];
        $rsp['data']       = json_decode($rsp['data'], 1);
        $data              = array();
        if (is_array($rsp['data']) && is_array($rsp['data']['data'])) {
            foreach ($rsp['data']['data'] as $v) {
                $data[] = array(
                    'shop_type'      => '360buy',
                    'outregion_id'   => $v['id'],
                    'outregion_name' => $v['name'],
                    'region_grade' =>isset($sdf['region_grade']) ? $sdf['region_grade'] : 1,
                );
            }
        }

        $result['data'] = $data;
        return $result;
    }
}
