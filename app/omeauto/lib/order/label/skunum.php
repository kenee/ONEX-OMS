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
 * 订单基础物料种类数
 */
class omeauto_order_label_skunum extends omeauto_order_label_abstract implements omeauto_order_label_interface
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
            $error_msg = '没有设置基础物料总数量规则';
            return false;
        }
        
        //基础物料种类数量
        $product_ids = array();
        foreach($orderInfo['order_objects'] as $objects)
        {
            foreach($objects['order_items'] as $value)
            {
                $product_id = $value['product_id'];
                
                if($value['delete'] == 'true'){
                    continue;
                }
                
                $product_ids[$product_id] = $product_id;
            }
        }
        
        //种类数量
        $skunum = count($product_ids);
        
        //check
        $isResult = false;
        switch($this->content['type'])
        {
            case 1:
                //小于指定种类数
                $isResult = ($skunum < $this->content['max'] ? true : false);
                if(!$isResult){
                    $error_msg = '订单SKU种类数量'. $skunum .',未小于指定种类数'. $this->content['max'];
                }
                
                break;
            case 2:
                //大于等于指定种类数
                $isResult = ($skunum >= $this->content['min'] ? true : false);
                if(!$isResult){
                    $error_msg = '订单SKU种类数量'. $skunum .',未大于等于指定种类数'. $this->content['min'];
                }
                
                break;
            case 3:
                //位于两个种类数之间
                if($skunum >= $this->content['min'] && $skunum < $this->content['max']){
                    $isResult = true;
                }
                
                if(!$isResult){
                    $error_msg = '订单SKU种类数量'. $skunum .',没有位于两个种类数之间('. $this->content['min'] .','. $this->content['max'] .')';
                }
                
                break;
            case 4:
                //等于指定种类数
                $isResult = ($skunum == $this->content['min'] ? true : false);
                if(!$isResult){
                    $error_msg = '订单SKU种类数量'. $skunum .',没有等于指定种类数'. $this->content['min'];
                }
                
                break;
        }
        
        return $isResult;
    }
}