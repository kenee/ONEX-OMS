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
 * 唯品会JITX仓库相关
 */
class erpapi_shop_matrix_vop_request_branch extends erpapi_shop_request_branch
{

    /**
     * 获取Warehouses
     * @param mixed $param param
     * @return mixed 返回结果
     */

    public function getWarehouses($param = [])
    {
        // $vop_param = array (
        //     'request' => array (
        //         'warehouse_type' => $param['warehouse_type'] ? $param['warehouse_type'] : '',
        //     )
        // );

        // //组织参数
        // // $vop_param    = $this->_format_api_params('getWarehouses', 0, $vop_param);
        // $vop_param['request'] = json_encode($vop_param);

        $vop_param = [];
        if ($param['warehouse_type']) {
            $vop_param['warehouse_type'] = $param['warehouse_type'];
        }

        $title      = '获取可用JITX仓库配置';
        $primary_bn = 'getWarehouses';

        $rsp = $this->__caller->call(SHOP_JITX_WAREHOUSES_GET, $vop_param, array(), $title, 10, $primary_bn);

        if ($rsp['data']) {
            $data = $rsp['data'];
            if (!is_array($rsp['data'])) {
                $data = json_decode($rsp['data'], 1);
            }
            if ($data['msg']) {
                $data['msg'] = json_decode($data['msg'], 1);
                $rsp['data'] = $data['msg']['result'];
            }
        }

        return $rsp;
    }

    /**
     * 获取CooperationNoList
     * @param mixed $param param
     * @return mixed 返回结果
     */
    public function getCooperationNoList($param = [])
    {
        $vop_param = [
            'page' => $param['page'] ? $param['page'] : 1,
        ];
        if ($param['warehouse']) {
            $vop_param['warehouse'] = $param['branch_bn'];
        }

        $title      = '获取合作编码信息接口';
        $primary_bn = 'getCooperationNoList';

        $rsp = $this->__caller->call(SHOP_GET_COOPERATIONNOLIST, $vop_param, array(), $title, 10, $primary_bn);

        if ($rsp['data']) {
            $data = $rsp['data'];
            if (!is_array($rsp['data'])) {
                $data = json_decode($rsp['data'], 1);
            }
            if ($data['msg']) {
                $data['msg']     = json_decode($data['msg'], 1);
                $rsp['data']     = $data['msg']['result']['cooperation_no_list'];
                $rsp['has_next'] = $data['msg']['result']['has_next'];
            }
        }

        return $rsp;
    }

}
