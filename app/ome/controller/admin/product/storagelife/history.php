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

class ome_ctl_admin_product_storagelife_history extends desktop_controller{

    var $name = "保质期批次历史";

    var $workground = "aftersale_center";

    function index(){
       $params = array(
            'title'=>'保质期批次历史',
            'actions'=>array(),
            'use_buildin_new_dialog' => false,
            'use_buildin_set_tag'=>false,
            'use_buildin_recycle'=>false,
            'use_buildin_export'=>true,
            'use_buildin_import'=>false,
            'use_buildin_filter' => true,
            'base_filter' => $filter,
         );
       $this->finder('ome_mdl_product_storagelife_history',$params);
    }
}