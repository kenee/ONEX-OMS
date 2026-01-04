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
 * 检查否需要检查同一用户订单
 *
 * @author hzjsq@msn.com
 * @version 0.1b
 */
class omeauto_auto_plugin_member extends omeauto_auto_plugin_abstract implements omeauto_auto_plugin_interface {

    /**
     * 是否支持批量审单 
     */
    protected $__SUP_REP_ROLE = false;

    /**
     * 状态码
     */
    protected $__STATE_CODE = omeauto_auto_const::__MEMBER_CODE;

    /**
     * 开始处理
     *
     * @param omeauto_auto_group_item $group 要处理的订单组
     * @return Array
     */
    public function process(& $group, &$confirmRoles=null) {

        $allow = true;
        if ($this->_useMemberGroup($confirmRoles)) {
            
            $orders = $group->getOrders();
            
            if (!empty($orders) && is_array($orders)) {
                
                $key = key($orders);
                
                #系统自动审单的订单,返回true
                if ($orders[$key]['is_sys_auto_combine'] === true){
                    return true;
                }
                
                if ($orders[$key]['shop_type'] == 'shopex_b2b'){
                    return true;
                }

                if($orders[$key]['shop_type'] == 'dangdang' && $orders[$key]['is_cod']=='true'){
                    return true;
                }

                if($orders[$key]['shop_type'] == 'amazon' && $orders[$key]['self_delivery']=='false'){
                    return true;
                }

                if($orders[$key]['shop_type'] == 'aikucun'){
                    return true;
                }

                $memberId = $orders[$key]['member_id'];
                $shopId = $orders[$key]['shop_id'];
                if($memberId>0){
                    $count = kernel::single('omeauto_auto_combine')->getCombineMemberCount($memberId, $shopId);
                    if ($count > count($orders)) {
                        $allow = false;
                        foreach ($orders as $order) {
                            $group->setOrderStatus($order['order_id'], $this->getMsgFlag());
                        }
                    }
                }
               
            }

            if (!$allow) {
                $group->setStatus(omeauto_auto_group_item::__OPT_HOLD, $this->_getPlugName());
            }
        }
    }

    /**
     * 获取配置信息
     *
     * @param void
     * @return array
     */
    private function _useMemberGroup($confirmRoles) {

        return (($confirmRoles['morder'] == '1') ? true : false);
    }

    /**
     * 获取该插件名称
     *
     * @param Void
     * @return String
     */
    public function getTitle() {

        return '订单多地址';
    }

    /**
     * 获取提示信息
     *
     * @param Array $order 订单内容
     * @return Array
     */
    public function getAlertMsg(& $order) {


        return array('color' => 'GREEN', 'flag' => '多', 'msg' => '该用户还有其它不同收货地址的订单');
    }

}