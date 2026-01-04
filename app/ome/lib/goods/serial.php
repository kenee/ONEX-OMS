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

class ome_goods_serial{
    /**
     * 唯一码状态
     * @access public
     * @return Array
     */
    static function serial_status(){
        $serial_status = array (
            '0' => '入库',
            '1' => '出库',
            '2' => '无效',
        );
        return $serial_status;
    }

    /**
     * 操作类型
     * @access public
     * @return Array
     */
    static function act_type(){
        $act_type = array (
            '0' => '出库效验',
            '1' => '入库效验',
        );
        return $act_type;
    }

    /**
     * 单据类型
     * @access public
     * @return Array
     */
    static function bill_type(){
        $bill_type = array (
            '0' => '发货单',
            '1' => '退货单',
        );
        return $bill_type;
    }
}