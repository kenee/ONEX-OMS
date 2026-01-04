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

/**
 * ============================
 * @Author:   yaokangming
 * @describe: 库存发布
 * ============================
 */
class inventorydepth_ctl_stock_release extends desktop_controller {
    public function index() {
        $actions = array();
        $actions[] = array(
            'label'  => '导入发布库存',
            'href'   => $this->url.'&act=execlImportDailog&p[0]=shop_adjustment',
            'target' => 'dialog::{width:500,height:300,title:\'导入发布库存\'}',
        );
        $params = array(
                'title'=>'库存发布',
                'use_buildin_set_tag'=>false,
                'use_buildin_filter'=>false,
                'use_buildin_export'=>false,
                'use_buildin_recycle'=>false,
                'actions'=>$actions,
                'orderBy'=>'id desc',
        );
        
        $this->finder('inventorydepth_mdl_stock_release', $params);
    }

    public function execlImportDailog($type = ''){
        $arrShopRequest = app::get('ome')->model('shop')->getList('shop_id, name, shop_type', ['node_id|noequal'=>'', 'delivery_mode'=>'self']);
        if(empty($arrShopRequest)) {
            die('缺少店铺');
        }
        $modeSupport = kernel::single('inventorydepth_sync_set')->getModeSupport();
        $this->pagedata['shop_request'] = $arrShopRequest;
        $this->pagedata['mode_support'] = $modeSupport;
        $this->pagedata['custom_html'] = $this->fetch('admin/shop/adjustment/import.html');
        parent::execlImportDailog($type);
    }
}