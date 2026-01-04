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

class ome_order_to_api {

    function run(&$cursor_id,$params){

        set_time_limit(300);
        $orderObj = app::get('ome')->model('orders');
        if (!is_array($params)){
            $params = unserialize($params);
        }
        $Sdf = $params['sdfdata'];
        $sdf_data = array();
        if ($Sdf)
        foreach ($Sdf as $k=>$v){
            //danny_freeze_stock_log
            define('FRST_TRIGGER_OBJECT_TYPE','订单：订单超过失效时间取消');
            define('FRST_TRIGGER_ACTION_TYPE','ome_order_to_api：run');
            $memo = "此订单已过期，且未付款未确认 ";
            $orderInfo = $orderObj->dump($v,'source');
            if($orderInfo['source'] == 'local'){
                $orderObj->cancel($v,$memo,false,'async', false);
            }else{
                $orderObj->cancel($v,$memo, true, 'sync', false);
            }
        }
        return false;
    }
}
