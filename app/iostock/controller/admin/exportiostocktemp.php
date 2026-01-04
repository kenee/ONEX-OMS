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

class iostock_ctl_admin_exportiostocktemp extends desktop_controller{

     function index(){
        $this->pagedata['iotype'] = array('采购入库'     => 'index.php?app=iostock&ctl=admin_purchase&act=exportTemplate',
                                          '采购退货'     => 'index.php?app=iostock&ctl=admin_purchaseReturns&act=exportTemplate',
                                          '换货入库'     => 'index.php?app=iostock&ctl=admin_changeorderreturns&act=exportTemplate',
                                          '退货入库'     => 'index.php?app=iostock&ctl=admin_orderreturns&act=exportTemplate',
                                          '商品调拨'     => 'index.php?app=iostock&ctl=admin_transfer&act=exportTemplate',
                                          '商品残损'     => 'index.php?app=iostock&ctl=admin_damaged&act=exportTemplate',
                                          '盘点差异过账' => 'index.php?app=iostock&ctl=admin_inventory&act=exportTemplate'
                                        );
        echo $this->page('admin/temp/download.html');
    }
}