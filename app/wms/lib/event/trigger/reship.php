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

class wms_event_trigger_reship{

    /**
     *
     * 退货更新状态发起方法
     * @param array 
     * @param string $sync 是否同步请求，true为同步，false异步，默认异步
     */
    public function updateStatus($wms_id, $data, $sync = false){
        
        //kernel::single('middleware_wms_response', $wms_id)->reship_result($data);
        $result = kernel::single('erpapi_router_response')->set_channel_id($wms_id)->set_api_name('wms.reship.status_update')->dispatch($data);
    }

    /**
     *
     * 退货更新状态发起方法发起的响应接收方法
     * @param string $po_bn
     */
    public function updateStatus_callback($res){

    }

}

?>
