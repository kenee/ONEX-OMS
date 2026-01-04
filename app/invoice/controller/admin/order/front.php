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
 * ============================
 * @Author:   yaokangming
 * @describe: 预发票列表
 * ============================
 */
class invoice_ctl_admin_order_front extends desktop_controller {
    public function index() {
        $actions = array();
        $params = array(
                'title'=>'预发票列表',
                'use_buildin_set_tag'=>false,
                'use_buildin_filter'=>false,
                'use_buildin_export'=>false,
                'use_buildin_recycle'=>false,
                'actions'=>$actions,
                'base_filter'=>['disabled'=>'false'],
                'orderBy'=>'id desc',
        );
        
        $this->finder('invoice_mdl_order_front', $params);
    }
}