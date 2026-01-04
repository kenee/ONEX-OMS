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
 * 唯品会JIT售后单
 */
class billcenter_ctl_admin_aftersales extends desktop_controller
{
    /**
     * index
     *
     **/
    public function index()
    {
        $params = [
            'title' => '售后单',
            'use_buildin_recycle' => false,
            'use_buildin_filter'=>true,
            'orderBy'                => 'id desc',
        ];
        $this->finder('billcenter_mdl_aftersales', $params);
    }
}