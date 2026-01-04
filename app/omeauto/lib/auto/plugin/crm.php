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
 * 检查淘宝订单是否有优惠赠品
 *
 * @author danny@shopex.cn
 * @version 0.1
 */
class omeauto_auto_plugin_crm extends omeauto_auto_plugin_abstract implements omeauto_auto_plugin_interface {

    /**
     * 是否支持批量审单
     */
    protected $__SUP_REP_ROLE = false;
    /**
     * 状态码
     */
    protected $__STATE_CODE = omeauto_auto_const::__CRMGIFT_CODE;

    /**
     * 开始处理
     *
     * @param omeauto_auto_group_item $group 要处理的订单组
     * @return Array
     */
    public function process(& $group, &$confirmRoles=null) {
        #获取crm基本配置
        $crm_cfg = app::get('crm')->getConf('crm.setting.cfg');
        #如果没有开启crm应用，程序返回
        if(empty($crm_cfg)){
            return false;
        }
        $allow = true;
        if($this->_checkStatus($confirmRoles)){
            foreach ($group->getOrders() as  $order) {
                if(($order['abnormal_status'] & ome_preprocess_const::__HASCRMGIFT_CODE) == ome_preprocess_const::__HASCRMGIFT_CODE){
                    $allow = false;
                    $group->setOrderStatus($order['order_id'], $this->getMsgFlag());
                    //break;
                }
            }
            
            $crm_cfg = app::get('crm')->getConf('crm.setting.cfg'); #获取crm基本配置
            #不添加赠品，继续审单发货
            if($crm_cfg['error'] == 'off'){
                $group->setStatus(omeauto_auto_group_item::__OPT_ALLOW, $this->_getPlugName());
            }elseif($allow){
                $group->setStatus(omeauto_auto_group_item::__OPT_ALLOW, $this->_getPlugName());
            }else{
                $group->setStatus(omeauto_auto_group_item::__OPT_HOLD, $this->_getPlugName());
            }
        }
    }

    /**
     * 检查是否启用超卖检查
     */
    private function _checkStatus($configRoles) {
        return true;
    }

    /**
     * 获取该插件名称
     *
     * @param Void
     * @return String
     */
    public function getTitle() {
        return 'CRM赠品出错订单';
    }

    /**
     * 获取提示信息
     *
     * @param Array $order 订单内容
     * @return Array
     */
    public function getAlertMsg(& $order) {
        return array('color' => 'RED', 'flag' => 'C', 'msg' => 'CRM赠品出错');
    }

}
