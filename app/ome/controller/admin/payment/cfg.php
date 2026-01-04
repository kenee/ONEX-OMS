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

class ome_ctl_admin_payment_cfg extends desktop_controller
{
    public $name       = "支付方式";
    public $workground = "setting_tools";
    /**
     * index
     * @return mixed 返回值
     */
    public function index()
    {
        $this->finder('ome_mdl_payment_cfg', array(
            'title'                 => '支付方式管理',
            'actions'               => array(
                // array('label' => '新增', 'href' => $this->url.'&act=add&finder_id='.$_GET['finder_id'],'target'=>'dialog::{width:690,height:200,title:\'新增支付方式\'}"'),
                array('label' => '同步', 'href' => 'index.php?app=ome&ctl=admin_payment_cfg&act=getPayment&finder_id=' . $_GET['finder_id']),
            ),
            'use_buildin_recycle'   => false,
            'use_buildin_selectrow' => false,
            'use_buildin_filter'    => true,
        ));
    }

    /**
     * 获取Payment
     * @return mixed 返回结果
     */
    public function getPayment()
    {
        $this->begin('index.php?app=ome&ctl=admin_payment_cfg');
        $shopObj  = app::get('ome')->model('shop');
        $shopList = $shopObj->getList('shop_id');
        foreach ($shopList as $shop) {
            kernel::single("ome_payment_func")->sync_payments($shop['shop_id']);
        }
        $this->end(true, app::get('base')->_('发送成功'));
    }

    /**
     * 添加
     * @return mixed 返回值
     */
    public function add()
    {
        $this->display('admin/payment/add.html');
    }

    /**
     * do_add
     * @return mixed 返回值
     */
    public function do_add()
    {
    }
}
