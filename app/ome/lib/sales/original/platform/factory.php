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

class ome_sales_original_platform_factory {
    static protected $coupon = [];
    static protected $api_version = '1.0';
    protected $platfomAmountType = [
    ];
    protected $platfomPayAmountType = [
    ];
    protected $platfomActualAmountType = [
        'calcActuallyPay'
    ];

    /** @return ome_sales_original_platform_factory */
    public function init($orderId, $shopType) {
        $filter = [];
        $filter['order_id'] = $orderId;
        self::$coupon = app::get('ome')->model('order_coupon')->getList('*', $filter);
        try {
            $obj = kernel::single('ome_sales_original_platform_'.$shopType);
            if(method_exists($obj, 'initOther')) {
                $obj->initOther($orderId, $shopType);
            }
        } catch (\Throwable $th) {
            $obj = $this;
        }
        self::$api_version = app::get('ome')->model('orders')->db_dump($orderId, 'api_version')['api_version'];
        return $obj;
    }

    public function getPlatformAmount($obj) {
        $amount = 0;
        foreach(self::$coupon as $v) {
            if($v['oid'] == $obj['oid']) {
                if(self::$api_version >= 3) {
                    if($v['coupon_type'] == 1) {
                        //$amount += $v['total_amount'];
                    }
                } else {
                    if(in_array($v['type'], $this->platfomAmountType)) {
                        $amount += $v['total_amount'];
                    }
                }
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
            if($v['oid'] == $obj['oid']) {
                if(self::$api_version >= 3) {
                    if($v['coupon_type'] == 3) {
                        $amount += $v['total_amount'];
                    }
                } else {
                    if(in_array($v['type'], $this->platfomPayAmountType)) {
                        $amount += $v['total_amount'];
                    }
                }
            }
        }
        return $amount;
    }

    /**
     * 获取ActualAmount
     * @param mixed $obj obj
     * @param mixed $platformPayAmount platformPayAmount
     * @return mixed 返回结果
     */
    public function getActualAmount($obj, &$platformPayAmount) {
        $amount = 0;
        $use_amount = false;
        foreach(self::$coupon as $v) {
            if($v['oid'] == $obj['oid']) {
                if(in_array($v['type'], $this->platfomActualAmountType)) {
                    $amount += $v['total_amount'];
                }
            }
            if(in_array($v['type'], $this->platfomActualAmountType) && $v['total_amount'] > 0) {
                $use_amount = true;
            }
        }
        if($use_amount) {
            $platformPayAmount = $obj['divide_order_fee'] - $amount;
            return $amount;
        }
        return $obj['divide_order_fee'] - $platformPayAmount;
    }
}
