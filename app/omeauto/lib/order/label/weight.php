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
 * 基础物料总重量总重量
 */
class omeauto_order_label_weight extends omeauto_order_label_abstract implements omeauto_order_label_interface
{
    /**
     * 检查订单数据是否符合要求
     *
     * @param array $orderInfo
     * @param string $error_msg
     * @return bool
     */
    public function vaild($orderInfo, &$error_msg=null)
    {
        if(empty($this->content)){
            $error_msg = '没有设置收货地区规则';
            return false;
        }
        
        //订单商品总重量
        $weight = app::get('ome')->model('orders')->getOrderWeight($orderInfo['order_id']);
        
        //check
        $isResult = false;
        switch($this->content['type']) {
            case 1:
                //小于指定总重量
                $isResult = ($weight < $this->content['max'] ? true : false);
                if(!$isResult){
                    $error_msg = '订单总重量'. $weight .',未小于总重量'. $this->content['max'];
                }
                
                break;
            case 2:
                //大于等于指定总重量
                $isResult = ($weight >= $this->content['min'] ? true : false);
                if(!$isResult){
                    $error_msg = '订单总重量'. $weight .',未大于等于总重量'. $this->content['min'];
                }
                
                break;
            case 3:
                //位于两个总重量之间
                if($weight >= $this->content['min'] && $weight < $this->content['max']){
                    $isResult = true;
                }
                
                if(!$isResult){
                    $error_msg = '订单总重量'. $weight .',未位于两个总重量之间('. $this->content['min'] .','. $this->content['max'] .')';
                }
                
                break;
            case 4:
                //等于指定总重量
                $isResult = ($weight == $this->content['min'] ? true : false);
                if(!$isResult){
                    $error_msg = '订单总重量'. $weight .',等于指定总重量'. $this->content['min'];
                }
                
                break;
        }
        
        return $isResult;
    }
}