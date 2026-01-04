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

class invoice_auth_baiwang implements invoice_auth_iconfig
{
    /**
     * 加载授权配置
     *
     * @return void
     * @author
     */
    public function getAuthConfigs()
    {
        $params = array (
            'username'  => array (
                'label'    => '用户名',
                'name'     => 'extend_data[username]',
                'required' => true,
            ),
            'password'  => array (
                'label'    => '密码',
                'name'     => 'extend_data[password]',
                'required' => true,
            ),
            'appKey'    => array (
                'label'    => 'appKey',
                'name'     => 'extend_data[appKey]',
                'required' => true,
            ),
            'appSecret' => array (
                'label'    => 'appSecret',
                'name'     => 'extend_data[appSecret]',
                'required' => true,
            ),
            'salt'      => array (
                'label'    => '用户盐值',
                'name'     => 'extend_data[salt]',
                'required' => true,
            ),
            'tax_no'    => array (
                'label'    => '机构税号',
                'name'     => 'extend_data[tax_no]',
                'required' => true,
            ),
        );

        return $params;
    }
}
