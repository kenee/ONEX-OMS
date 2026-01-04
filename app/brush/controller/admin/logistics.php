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
 * @author ykm 2016-01-07
 * @describe 特殊订单批量更换物流公司
 */

class brush_ctl_admin_logistics extends desktop_controller{

    function toChangeLogistics() {
        if($_POST['isSelectedAll'] == '_ALL_') {
            $filter = array_merge($_POST, $_GET);
        } else {
            $filter = array('delivery_id' => $_POST['delivery_id']);
        }
        $deliverys = $this->app->model('delivery')->getList('delivery_id, delivery_bn', $filter);
        if (empty($deliverys)) {
            die('没有选择任何可操作的发货单。');
        }
        $ids = array();
        foreach ($deliverys as $delivery) {
            $ids[] = $delivery['delivery_id'];
        }
        $dlyCrop = app::get('ome')->model('dly_corp')->getList('corp_id, name, type, is_cod, weight, tmpl_type', array('disabled' => 'false'), 0, -1, 'weight DESC');

        $this->pagedata['ids'] = join(',', $ids);
        $this->pagedata['dlyCorp'] = $dlyCrop;
        $this->pagedata['orderCnt'] = count($ids);
        $this->display('admin/delivery/change_logistics.html');
    }

    function changeLogistics() {
        $deliveryIds = explode(',', $_POST['ids']);
        $logiId = $_POST['logi_id'];
        if(empty($deliveryIds) || empty($logiId)) {
            $this->splash('error', '', '请选择新物流公司');
        }
        $corp = app::get('ome')->model('dly_corp')->getList('corp_id, name', array('disabled'=>'false'), 0, -1);
        $arrCorp = array();
        foreach($corp as $value) {
            $arrCorp[$value['corp_id']] = $value['name'];
        }
        $delivery = $this->app->model('delivery')->getList('*', array('delivery_id'=>$deliveryIds));
        $data = array(
            'logi_id' => $logiId,
            'logi_no' => null
        );
        $failDeliveryBn = array();
        $objLogistics = kernel::single('brush_logistics');
        $db = kernel::database();
        $this->begin();
        foreach($delivery as $val) {
            if($val['logi_id'] == $data['logi_id']) {
                continue;
            }
            $ret = $objLogistics->checkChangeLogistics($data, $val);
            if($ret['result']) {
                $db->exec('SAVEPOINT changeLogistics');
                $logMsg = '批量物流公司切换：' . $arrCorp[$val['logi_id']] . ' => ' . $arrCorp[$data['logi_id']];
                if(!$objLogistics->changeLogistics($data, $val['delivery_id'], $logMsg)) {
                    $failDeliveryBn[] = $val['delivery_bn'];
                    $db->exec('ROLLBACK TO SAVEPOINT changeLogistics');
                }
            } else {
                $failDeliveryBn[] = $val['delivery_bn'];
            }
        }
        $msg = $failDeliveryBn ? '设置完成，其中' . implode(',', $failDeliveryBn) . '设置失败' : '设置成功';
        $this->end(true, $msg);
    }
}