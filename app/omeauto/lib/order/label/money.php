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
 * 订单金额
 */
class omeauto_order_label_money extends omeauto_order_label_abstract implements omeauto_order_label_interface
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
            $error_msg = '没有设置订单金额规则';
            return false;
        }
        
        //订单总额
        $total_amount = $orderInfo['total_amount'];
        
        //check
        $isResult = false;
        switch($this->content['type'])
        {
            case 1:
                //小于指定金额
                $isResult = ($total_amount < $this->content['max'] ? true : false);
                if(!$isResult){
                    $error_msg = '订单总金额'. $total_amount .'小于指定金额'. $this->content['max'];
                }
                
                break;
            case 2:
                //大于等于指定金额
                $isResult = ($total_amount >= $this->content['min'] ? true : false);
                if(!$isResult){
                    $error_msg = '订单总金额'. $total_amount .'未大于等于指定金额'. $this->content['min'];
                }
                
                break;
            case 3:
                //位于两个金额之间
                if($total_amount >= $this->content['min'] && $total_amount < $this->content['max']){
                    $isResult = true;
                }
                
                if(!$isResult){
                    $error_msg = '订单总金额'. $total_amount .'不在指定金额范围('. $this->content['min'] .','. $this->content['max'] .')';
                }
                
                break;
        }
        
        return $isResult;
    }
}