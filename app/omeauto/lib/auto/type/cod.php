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
 * 货到付款
 */
class omeauto_auto_type_cod extends omeauto_auto_type_abstract implements omeauto_auto_type_interface {

    /**
     * 检查输入的参数
     * 
     * @param Array $params
     * @returm mixed
     */
    public function checkParams($params) {

        if (!$params['is_cod'] || $params['is_cod']=='') {

            return "你还没有选择相应的订单类型\n\n请选择以后再试！！";
        }

        return true;
    }

    /**
     * 生成规则字串
     * 
     * @param Array $params
     * @return String
     */
    public function roleToString($params) {
        if($params['is_cod'] && $params['is_cod']=='true'){
            $caption = '货到付款订单';
        }else{
            $caption = '款到发货订单';
        }

        $role = array('role' => 'cod', 'caption' => $caption, 'content' => $params['is_cod']);

        return json_encode($role);
    }

    /**
     * 检查订单数据是否符合要求
     * 
     * @param omeauto_auto_group_item $item
     * @return boolean
     */
    public function vaild($item) {

        if (!empty($this->content)) {

            foreach ($item->getOrders() as $order) {
                //检查店铺
                if ($order['is_cod'] != $this->content) {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }

}