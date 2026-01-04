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

class wms_receipt_purchase{

    private static $status = array(

    );


    /**
     *
     * 采购通知单创建方法
     * @param array $data 采购通知单数据信息
     */
    public function create(&$data){

    }

    /**
     *
     * 采购通知单状态变更
     * @param array $po_bn 采购单编号
     */
    public function updateStatus($po_bn){

    }

    /**
     *
     * 检查采购通知单是否存在判断
     * @param array $po_bn 采购单编号
     */
    public function checkExist($po_bn){
        return true;
    }

    /**
     *
     * 检查采购通知单是否有效
     * @param array $po_bn 采购单编号
     */
    public function checkValid($po_bn){
        return true;
    }
}