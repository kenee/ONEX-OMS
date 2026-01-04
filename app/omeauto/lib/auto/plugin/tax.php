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
 * 检查是否开发票
 *
 * @author danny@shopex.cn
 * @version 0.1
 */
class omeauto_auto_plugin_tax extends omeauto_auto_plugin_abstract implements omeauto_auto_plugin_interface {

    /**
     * 是否支持批量审单
     */
    protected $__SUP_REP_ROLE = false;
    /**
     * 状态码
     */
    protected $__STATE_CODE = omeauto_auto_const::__TAX_CODE;

    /**
     * 开始处理
     *
     * @param omeauto_auto_group_item $group 要处理的订单组
     * @return Array
     */
    public function process(& $group, &$confirmRoles=null) {
        #没有配置发票检测开关
        if(!isset($confirmRoles['tax'])){
            return false;
        }
        #配置中不需要检查发票
        if($confirmRoles['tax'] == '0'){
            return false;
        }
        $allow = true;
        if($this->_checkStatus($confirmRoles)){
            foreach ($group->getOrders() as  $order) {
                if($order['is_tax'] == 'true'){
                    $allow = false;
                    $group->setOrderStatus($order['order_id'], $this->getMsgFlag());
                    break;
                }
            }
        
            if(!$allow){
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
    private function _checkStatus($configRoles) {
        if ($configRoles['tax'] == '1') {
           return true;
        }else{
            return false;
        }
    }   


    /**
     * 获取该插件名称
     *
     * @param Void
     * @return String
     */
    public function getTitle() {
        return '订单需要开发票';
    }

    /**
     * 获取提示信息
     *
     * @param Array $order 订单内容
     * @return Array
     */
    public function getAlertMsg(& $order) {
        return array('color' => 'RED', 'flag' => '票', 'msg' => '订单需要开发票');
    }

}
