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

class erpapi_idaas_request_organization extends erpapi_idaas_request_abstract
{
    /**
     * 开票
     * @param  [type] $sdf [description]
     * @return [type]      [description]
     */
    public function create($sdf)
    {
        $title = 'IDAAS同步组织架构';

        $params = array(
            'org_name'     => base_shopnode::node_id('ome'),
            'external_id'  => base_shopnode::node_id('ome'),
            'external_pid' => '7769495049577975511',
            'source'         => $sdf['source'],
            'domain'         => base_request::get_host(),
        );

        $rsp = $this->__caller->call(IDAAS_ORGANIZATION_CREATE, $params, array(), $title, 10, $sdf['org_name']);

        return $rsp;

    }

    /**
     * 查询组织架构
     * @param  [type] $sdf [description]
     * @return [type]      [description]
     */
    public function get($sdf)
    {
        $title = 'IDAAS查询组织架构';

        $params = array(
            'external_id' => base_shopnode::node_id('ome'),
            'source'         => $sdf['source'],
            'domain'         => base_request::get_host(),
        );

        $rsp = $this->__caller->call(IDAAS_ORGANIZATION_GET, $params, array(), $title, 10);

        return $rsp;

    }

}
