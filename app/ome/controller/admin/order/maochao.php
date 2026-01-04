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
 * @Version:  1.0
 * @DateTime: 2022/7/4 15:36:49
 * @describe: 猫超国际
 * ============================
 */
class ome_ctl_admin_order_maochao extends desktop_controller {

    /**
     * index
     * @return mixed 返回值
     */

    public function index() {}

    /**
     * reject
     * @return mixed 返回值
     */
    public function reject() {
        $order_id = (int) $_GET['order_id'];
        $order = app::get('ome')->model('orders')->db_dump(['order_id'=>$order_id], 'order_id,shop_id,order_bn');
        $returnAddress = app::get('ome')->model('return_address')->getList('*', ['shop_id'=>$order['shop_id']]);
        if(empty($returnAddress)) {
            die('缺少退货地址，请到售后设置-地址库维护中设置');
        }
        $ra_options = [];
        foreach ($returnAddress as $key => $value) {
            $ra_options[$value['address_id']] = $value['contact_name'].'  '.$value['mobile_phone'].'  '.$value['province'].'  '.$value['city'].'  '.$value['country'].'  '.$value['addr'].'  '.$value['zip_code'];
            if($value['cancel_def'] == 'true') {
                $this->pagedata['return_address_default'] = $value['address_id'];
            }
        }
        $this->pagedata['order'] = $order;
        $this->pagedata['reverse_type'] = [1=>'客退',2=>'运配异常',3=>'拒签退回',4=>'拦截退回',5=>'上门取退'];
        $this->pagedata['return_address_options'] = $ra_options;
        $this->display('admin/order/maochao/reject.html');
    }

    /**
     * doReject
     * @return mixed 返回值
     */
    public function doReject() {
        $url = 'index.php?app=ome&ctl=admin_order';
        $order_id = (int) $_POST['order_id'];
        $address_id = (int) $_POST['address_id'];
        $reverse_type = (int) $_POST['reverse_type'];
        $order = app::get('ome')->model('orders')->db_dump(['order_id'=>$order_id, 'ship_status'=>'1']);
        if(empty($order)) {
            $this->splash('error', $url, '订单非发货状态');
        }
        list($rs, $data) = kernel::single('ome_event_trigger_shop_order')->reject($order, $address_id, $reverse_type);
        if(!$rs) {
            $this->splash('error', $url, '拒收申请失败:'.$data['msg']);
        }
        $this->splash('success', $url);

    }
}