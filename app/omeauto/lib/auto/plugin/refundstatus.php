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
 * @Version:  1.0 
 * @DateTime: 2022/9/27 15:51:09
 * @describe: 查看退款状态
 * ============================
 */

class omeauto_auto_plugin_refundstatus extends omeauto_auto_plugin_abstract implements omeauto_auto_plugin_interface {

    /**
     * 是否支持批量审单
     */
    protected $__SUP_REP_ROLE = false;
    
    /**
     * 状态码
     */
    protected $__STATE_CODE = omeauto_auto_const::_REFUNDSTATUS_CODE;

    /**
     * 开始处理
     *
     * @param omeauto_auto_group_item $group 要处理的订单组
     * @return Array
     */
    public function process(&$group, &$confirmRoles=null) {
        $arrOrder = $group->getOrders();
        foreach ($arrOrder as $order) {
            list($rs, $rsData) = kernel::single('ome_order_refund')->checkRefundStatus($order);
            if($rs) {
                app::get('ome')->model('operation_log')->write_log('order_confirm@ome',$order['order_id'],"退款状态查询：".$rsData['msg']);
                $group->setOrderStatus($order['order_id'], $this->getMsgFlag());
                $group->setStatus(omeauto_auto_group_item::__OPT_ALERT, $this->_getPlugName());
                break;
            }
        }
    }

     /**
     * 获取该插件名称
     *
     * @param Void
     * @return String
     */
    public function getTitle() {

        return '存在退款';
    }

    /**
     * 获取提示信息
     *
     * @param Array $order 订单内容
     * @return Array
     */
    public function getAlertMsg(& $order) {

        return array('color' => 'YELLOW', 'flag' => '退' ,'msg' => '存在退款明细');
    }
}