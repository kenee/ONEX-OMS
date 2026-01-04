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
 * 订单object明细二进制常量类
 *
 * @author wangbiao<wangbiao@shopex.cn>
 * @version 0.1
 */
class ome_order_bool_objecttype
{
    //是否保价SKU明细
    const __PRICE_PROTECT_CODE = 0x0001;
    
    //顺手买一件活动
    const __ACTIVITY_PURCHASE_CODE = 0x0002;
    
    private $boolStatus = array(
        self::__PRICE_PROTECT_CODE => array('identifier'=>'保', 'text'=>'价保商品', 'color'=>'red'),
        self::__ACTIVITY_PURCHASE_CODE=> array('identifier' => '顺', 'text' => '顺手买一件活动', 'color' => '#E9967A', 'search' => 'true'),
    );
    
    /**
     * 获取BoolTypeText
     * @param mixed $num num
     * @return mixed 返回结果
     */

    public function getBoolTypeText($num = null)
    {
        if ($num) {
            return (array) $this->boolStatus[$num];
        }
        return $this->boolStatus;
    }
    
    //是否价保商品
    /**
     * isPriceProtect
     * @param mixed $boolType boolType
     * @return mixed 返回值
     */
    public function isPriceProtect($boolType)
    {
        return $boolType & self::__PRICE_PROTECT_CODE ? true : false;
    }
    
    /**
     * isActivityPurchase
     * @param mixed $boolType boolType
     * @return mixed 返回值
     */
    public function isActivityPurchase($boolType)
    {
        return $boolType & self::__ACTIVITY_PURCHASE_CODE ? true : false;
    }
}
