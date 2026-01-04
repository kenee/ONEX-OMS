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


class wms_event_trigger_inventory{

    /**
     * 请求控制台盘盈事件
     */
    public function overage(){
    
    }

    /**
     * 请求控制台盘亏事件
     */
    public function shortage(){

    }

    /***
    * 盘点申请单
    * 
    */
    public function apply($wms_id, $data, $sync = false) {
       
        //$result = kernel::single('middleware_wms_response', $wms_id)->inventory_result($data, $sync);
        $result = kernel::single('erpapi_router_response')->set_channel_id($wms_id)->set_api_name('wms.inventory.add')->dispatch($data);
        return $result;
    }
}

?>
