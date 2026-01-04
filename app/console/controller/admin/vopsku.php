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
 * 唯品会JIT供货价
 * 
 * @access public
 * @author chenping
 * @version 1.0 vopurchase.php 2017-02-23
 */
class console_ctl_admin_vopsku extends desktop_controller{
    
    var $workground = "console_purchasecenter";
    
    
    function index()
    {
        $this->title = '采购单供货价';
        
        $params = array(
            'title'=>$this->title,
            'use_buildin_set_tag'=>false,
            'use_buildin_filter'=>true,
            'use_buildin_export'=>false,
            'use_buildin_import'=>false,
            'use_buildin_recycle'=>false,
        );
        
        $this->finder('purchase_mdl_order_sku_price', $params);
    }
}