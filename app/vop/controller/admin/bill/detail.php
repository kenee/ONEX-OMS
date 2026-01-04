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
 * sunjing@shopex.cn
 */
class vop_ctl_admin_bill_detail extends desktop_controller {

    public function index() {
        $actions = array();
        $base_filter = array();
        if($_GET['bill_id']){
            $base_filter['bill_id'] = $_GET['bill_id'];
        }
        $params = array(
                'title'=>'JIT费用项',
                'base_filter' => $base_filter,
                'use_buildin_set_tag'=>false,
                'use_buildin_filter'=>true,
                'use_buildin_export'=>false,
                'use_buildin_import'=>false,
                'use_buildin_recycle'=>false,
                'actions'=>$actions,
        );
        
        $this->finder('vop_mdl_source_detail', $params);
    }


   
}