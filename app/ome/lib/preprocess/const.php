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
 * 定义异常标识
 *
 * @author hzjsq@msn.com
 * @version 0.1
 */
class ome_preprocess_const
{
    //淘宝订单有赠品信息
    const __HASGIFT_CODE        = 0x00000001;
    
    //crm打标处理状态
    const __HASCRMGIFT_CODE        = 0x00000020;
    
    // 天猫物流升级异常
    const __CPUPAB_CODE         = 0x00000040;
    
    //抖音换货仅退款异常
    const __EXCHANGE_REFUND_CODE = 0x00000080;
    
    //编辑订单失败时,更新异常状态
    const __ORDER_REFUND_ABNORMAL = 0x00000100;
    
    //福袋订单失败时,更新异常状态
    const __ORDER_LUCKY_FAIL = 0x00000200;
    
    //异常标识列表
    private $boolStatus = array(
        self::__HASGIFT_CODE => array('identifier'=>'赠', 'text'=>'淘宝订单有赠品信息', 'color'=>'red'),
        self::__HASCRMGIFT_CODE => array('identifier'=>'CRM', 'text'=>'crm打标处理状态', 'color'=>'blue'),
        self::__CPUPAB_CODE => array('identifier'=>'物', 'text'=>'天猫仓配未映射', 'color'=>'#fd6666'),
        self::__EXCHANGE_REFUND_CODE => array('identifier'=>'换', 'text'=>'抖音换货仅退款异常', 'color'=>'green'),
        self::__ORDER_REFUND_ABNORMAL => array('identifier'=>'退', 'text'=>'删除已退款商品失败', 'color'=>'yellow'),
        self::__ORDER_LUCKY_FAIL => array('identifier'=>'福', 'text'=>'福袋商品失败', 'color'=>'orange'),
    );
    
    /**
     * 获取异常标识
     * @param $boolType
     * @param $shop_type
     * @return string
     */
    public function getBoolTypeIdentifier($boolType, $shop_type='')
    {
        $str = '';
        
        //check
        if(empty($boolType)){
            return $str;
        }
        
        foreach ($this->boolStatus as $boolKey => $val)
        {
            if($boolType & $boolKey){
                $str .= sprintf("<span class='tag-label' title='%s' style='background-color:%s;color:#000000;'>%s</span>", $val['text'], $val['color'], $val['identifier']);
            }
        }
        
        return $str;
    }
}