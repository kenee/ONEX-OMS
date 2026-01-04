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
 * 设置并检查物流号
 *
 * @author hzjsq@msn.com
 * @version 0.1b
 */

class omeauto_auto_plugin_logikeyword extends omeauto_auto_plugin_abstract implements omeauto_auto_plugin_interface {

    /**
     * 是否支持批量审单
     */
    protected $__SUP_REP_ROLE = false; 
    
    /**
     * 快递配置信息
     * @var $array
     */
    static $keyList = null;

    /**
     * 状态码
     * @var integer
     */
    protected $__STATE_CODE = omeauto_auto_const::__LOGI_LITE_CODE;

    /**
     * 开始处理
     *
     * @param omeauto_auto_group_item $group 要处理的订单组
     * @return Array
     */
    public function process(& $group, &$confirmRoles=null) {

        //自动匹配物流公司
        $this->initKeywords();
        $allow = true;
        if (is_array(self::$keyList)) {           
            foreach ($group->getOrders() as $order) {
               foreach (self::$keyList as $keyword) {
                    if (strpos($order['ship_addr'], $keyword['keyword'])!==false) {
                        $allow = false;
                        $group->setOrderStatus($order['order_id'], $this->getMsgFlag());
                        break;
                    }
                }
            }
        }

        if (!$allow) {
            //不能匹配
            $group->setOrderStatus('*', $this->getMsgFlag());
        }
    }
    
    /**
     * 初始化关键字
     * 
     * @param void
     * @return void
     */
    private function initKeywords() {
        
        if (self::$keyList === null) {
            
            self::$keyList = (array) app::get('omestart')->model('ship_keyword')->getlist('keyword');
        }
    }

     /**
     * 获取该插件名称
     *
     * @param Void
     * @return String
     */
    public function getTitle() {

        return '物流关键字';
    }
 
    /**
     * 获取提示信息
     *
     * @param Array $order 订单内容
     * @return Array
     */
    public function getAlertMsg(& $order) {

        return array('color' => 'BLUE', 'flag'=>'村' , 'msg' => '该发货地址中存有关注的物流关键字');
    }
}