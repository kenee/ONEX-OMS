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
 * 物流包裹明细列表
 * Class wms_ctl_admin_delivery_bill_items
 */
class wms_ctl_admin_delivery_bill_items extends desktop_controller
{
    public $name       = '物流包裹明细列表';
    public $workground = 'console_center';

    /**
     * 物流包裹列表
     */
    public function index()
    {
        $params = array(
            'use_buildin_new_dialog' => false,
            'use_buildin_set_tag'    => false,
            'use_buildin_recycle'    => false,
            'use_buildin_import'     => false,
            'use_buildin_export'     => true,
            'use_buildin_filter'     => true,
            'use_view_tab'           => true,
            'actions'                => [],
            'title'                  => '物流包裹明细列表',
            'base_filter'            => [],
        );

        $this->finder('wms_mdl_delivery_bill_items', $params);
    }
}
