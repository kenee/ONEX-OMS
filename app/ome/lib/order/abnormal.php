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
 * 订单异常处理类
 *
 * @category 
 * @package 
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class ome_order_abnormal
{
    /**
     * 订单设异常
     *
     * @param Int $order_id 订单号
     * @param String $abnormal_type 异常类型
     * @return void
     * @author 
     **/
    public function abnormal_set($order_id,$abnormal_type)
    {
        $abnormalModel     = app::get('ome')->model('abnormal');
        $abnormalTypeModel = app::get('ome')->model('abnormal_type');

        // 异常类型选择
        $abnormalTypeInfo = $abnormalTypeModel->dump(array('type_name'=>$abnormal_type),'type_id,type_name');
        if (!$abnormalTypeInfo) {
            $abnormalTypeInfo = array('type_name'=>$abnormal_type);
            $abnormalTypeModel->save($abnormalTypeInfo);
        }

        $abnormalData = array('abnormal_type_id'=>$abnormalTypeInfo['type_id']);

        $abnormalInfo = $abnormalModel->dump(array('order_id'=>$order_id),'abnormal_id,abnormal_memo');
        if($abnormalInfo){
            $abnormalData['abnormal_id'] = $abnormalInfo['abnormal_id'];
            $abnormalData['abnormal_memo'] = @unserialize($abnormalInfo['abnormal_memo']) ? unserialize($abnormalInfo['abnormal_memo']) : array();
        }

        $opInfo = kernel::single('ome_func')->getDesktopUser();
        $abnormalData['abnormal_memo'][] = array(
            'op_name' => $opInfo['op_name'],
            'op_time' => date('Y-m-d H:i'),
            'op_content' => $abnormal_type.'，订单设为异常并暂停。',
        );

        $abnormalData['abnormal_memo']      = serialize($abnormalData['abnormal_memo']);
        $abnormalData['abnormal_type_name'] = $abnormal_type;
        $abnormalData['is_done']            = 'false';
        $abnormalData['order_id']           = $order_id;

        $abnormalModel->save($abnormalData);

        // 订单暂停并设置为异常
        $orderModel = app::get('ome')->model('orders');
        $orderData = array('order_id'=>$order_id,'pause'=>'true','abnormal'=>'true');
        $result = $orderModel->save($orderData);
        $orderModel->pauseOrder($order_id, false, '');
        return $result;
    }
}