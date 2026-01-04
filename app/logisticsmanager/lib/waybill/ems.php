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

class logisticsmanager_waybill_ems extends logisticsmanager_waybill_abstract implements logisticsmanager_waybill_interface {
    //获取物流公司
    /**
     * logistics
     * @param mixed $logistics_code logistics_code
     * @param mixed $shop_id ID
     * @return mixed 返回值
     */
    public function logistics($logistics_code = '', $shop_id = '') {
        $logistics = array(
            'EMS'=>array('code'=>'EMS','name'=>'普通EMS'),
            'EYB'=>array('code'=>'EYB','name'=>'经济EMS'),
            'EMSPACK'=>array('code'=>'EMSPACK','name'=>'快递包裹'),
        );

        if(!empty($logistics_code)) {
            return $logistics[$logistics_code];
        }

        return $logistics;
    }

    /**
     * businessType
     * @param mixed $logistics_code logistics_code
     * @return mixed 返回值
     */
    public function businessType($logistics_code) {
        $businessType = array(
            'EMS'=>1,
            'EYB'=>4,
            'EMSPACK'=>9,
        );

        if(!empty($logistics_code)) {
            return $businessType[$logistics_code];
        }

        return $businessType;
    }

    //获取物流公司编码
    /**
     * logistics_code
     * @param mixed $businessType businessType
     * @return mixed 返回值
     */
    public function logistics_code($businessType) {
        $logistics_code = array(
            1 => 'EMS',
            4 => 'EYB',
            9=>'EMSPACK',
        );

        if(!empty($businessType)) {
            return $logistics_code[$businessType];
        }

        return $logistics_code;
    }

    
}