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
 * @description 库存管理接口类
 * @access public
 */
interface  ome_store_manage_interface{

    public function addDly($params, &$err_msg);

    public function cancelDly($params, &$err_msg);

    public function consignDly($params, &$err_msg);

    public function pauseOrd($params, &$err_msg);

    public function renewOrd($params, &$err_msg);
    
    public function checkChangeReship($params, &$err_msg);
    
    public function refuseChangeReship($params, &$err_msg);
    
    public function confirmReshipReturn($params, &$err_msg);
    
    public function confirmReshipChange($params, &$err_msg);
    
    public function reshipReturnRefuseChange($params, &$err_msg);
    
    public function editChangeToReturn($params, &$err_msg);
    
    public function checkReturned($params, &$err_msg);
    
    public function finishReturned($params, &$err_msg);
    
    public function cancelReturned($params, &$err_msg);
    
    public function checkStockout($params, &$err_msg);
    
    public function finishStockout($params, &$err_msg);
    
    public function saveStockdump($params, &$err_msg);
    
    public function finishStockdump($params, &$err_msg);
    
    public function checkVopstockout($params, &$err_msg);
    
    public function finishVopstockout($params, &$err_msg);
}