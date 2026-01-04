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

class sales_ctl_admin_delivery extends desktop_controller
{
    
    public $name = '单据';
    public $workground = 'invoice_center';
    
    /**
     * index
     * @return mixed 返回值
     */
    public function index()
    {
        $this->title = '发货销售单';
        
        $organization_permissions = kernel::single('desktop_user')->get_organization_permission();
        if ($organization_permissions) {
            $base_filter['org_id'] = $organization_permissions;
        }
        
        $params = array(
            'title'               => $this->title,
            'use_buildin_recycle' => false,
            'use_buildin_export'  => true,
            'use_buildin_filter'  => true,
            'orderBy'             => 'delivery_id desc',
            'base_filter'         => $base_filter,
        );
        $this->finder('sales_mdl_delivery_order', $params);
    }
    
    
    /**
     * item
     * @return mixed 返回值
     */
    public function item()
    {
        $this->title = '发货销售明细单';
        
        $organization_permissions = kernel::single('desktop_user')->get_organization_permission();
        if ($organization_permissions) {
            $base_filter['org_id'] = $organization_permissions;
        }
        
        $params = array(
            'title'               => $this->title,
            'use_buildin_recycle' => false,
            'use_buildin_export'  => true,
            'use_buildin_filter'  => true,
            'orderBy'             => 'id desc',
            'base_filter'         => $base_filter,
        );
        $this->finder('sales_mdl_delivery_order_item', $params);
    }
    
    
}
