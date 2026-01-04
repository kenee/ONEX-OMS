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

class invoice_auth_chinaums implements invoice_auth_iconfig
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
            'merchant_id' => array (
                'label'    => '商户号',
                'name'     => 'extend_data[merchant_id]',
                'required' => true,
                'size'     => 50,
            ),
            'terminal_id' => array (
                'label'    => '终端号',
                'name'     => 'extend_data[terminal_id]',
                'required' => true,
                'size'     => 50,
            ),
            'msg_src'     => array (
                'label'    => '消息来源',
                'name'     => 'extend_data[msg_src]',
                'required' => true,
                'size'     => 50,
            ),
            'secret'      => array (
                'label'    => '秘钥',
                'name'     => 'extend_data[secret]',
                'required' => true,
                'size'     => 50,
            ),
        );

        return $params;
    }
}
