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

class ome_sales_original_platform_luban extends ome_sales_original_platform_factory {
    protected $platfomAmountType = [
        'platform_cost_amount',
    ];
    protected $platfomPayAmountType = [
        'promotion_pay_amount',
    ];

    /**
     * 获取PlatformAmount
     * @param mixed $obj obj
     * @return mixed 返回结果
     */
    public function getPlatformAmount($obj) {
        $amount = 0;
        foreach(self::$coupon as $v) {
            if($v['oid'] == $obj['oid'] && in_array($v['type'], $this->platfomAmountType)) {
                $amount += $v['amount'];
            }
        }
        // echo 'coupon:', var_export(self::$coupon, 1), "\n";
        // echo 'platfomAmountType:', var_export($this->platfomAmountType, 1), "\n";
        return $amount;
    }

    /**
     * 获取PlatformPayAmount
     * @param mixed $obj obj
     * @return mixed 返回结果
     */
    public function getPlatformPayAmount($obj) {
        $amount = 0;
        foreach(self::$coupon as $v) {
            if($v['oid'] == $obj['oid'] && in_array($v['type'], $this->platfomPayAmountType)) {
                $amount += $v['amount'];
            }
        }
        return $amount;
    }
}