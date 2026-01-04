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
*  品骏对接
 * sunjing@shopex.cn
 *
 */
class logisticsmanager_waybill_pinjun
{
    /**
     * 默认订单来源类型
     * @var String 默认来源
     */
    public static $defaultChannelsType = 'OTHER';

    /**
     * 获取物流公司编码
     * @param Sring $logistics_code 物流代码
     */

    public function logistics($logistics_code = '') {
        $logistics = array(
            'PJ' => array('code'=>'PJ','name'=>'标准快递'),
        );

        if (!empty($logistics_code)) {
            return $logistics[$logistics_code];
        }
        return $logistics;
    }
    
    public static $payMethod = array(
        '0' => array('code' => '0', 'name' => '寄付月结'),
        '1' => array('code' => '1', 'name' => '寄付现结'),
        '2' => array('code' => '2', 'name' => '到付现结'),
        '3' => array('code' => '3', 'name' => '到付月结'),

     );

    public function pay_method($method = '') {

        if (!empty($method)) {
            return self::$payMethod[$method];
        }
        return self::$payMethod;
    }
}
