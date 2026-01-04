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

class logisticsmanager_waybill_aikucun {
    //获取物流公司
    /**
     * logistics
     * @param mixed $logistics_code logistics_code
     * @return mixed 返回值
     */
    public function logistics($logistics_code = '') {
        $logistics = array(
            'ZTO'        => array('code' => 'ZTO', 'name' => '中通速递','mode'=>'join'),
            'YUNDA'      => array('code' => 'YUNDA', 'name' => '韵达快递','mode'=>'join'),
            'YTO'        => array('code' => 'YTO','name'=>'圆通快递','mode'=>'join'),
            'DBL'       => array('code' => 'DBL','name'=>'德邦快递','mode'=>'direct'),
            'UC'         => array('code' => 'UC', 'name'=>'优速快递','mode'=>'join'),
            'JD'         => array('code' => 'JD', 'name'=>'京东快递'),
        );

        if(!empty($logistics_code)) {
            return $logistics[$logistics_code];
        }

        return $logistics;
    }

}