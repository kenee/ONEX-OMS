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


class finance_io_bill_func{

    public static function save($sdf = array(),&$mdl){
        $result = array('status'=>'success');
        $service = kernel::single('finance_bill');
        $result = $service->do_save($sdf);
        return $result;
    }

    public static function ar_save($sdf = array(),&$mdl){
        $result = array('status'=>'success');
        $service = kernel::single('finance_ar');
        $service->isTransaction = false;
        $result = $service->do_save($sdf);
        return $result;
    }

    public static function unique_id($arr = array()){
        return finance_func::unique_id($arr);
    }

    public static function get_public($task_id = ''){
        $public_info = array();
        if($task_id){
            $public_info = '';
        }
        return $public_info;
    }

    public static function order_is_exists($order_bn = ''){
        $rs = kernel::single('finance_func')->order_is_exists($order_bn);
        return $rs;
    }

    public static function getShopByShopID($shop_id = ''){
        $rs = kernel::single('finance_func')->getShopByShopID($shop_id);
        return $rs;
    }

}
?>