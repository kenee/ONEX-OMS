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


class wms_event_trigger_deliveryrefuse{

    /**
     * 拒收通知前台
     */
    public function updateStatus($wms_id, $data, $sync = false){
       
        //kernel::single('middleware_wms_response', $wms_id)->reship_result($data, $sync);
        $result = kernel::single('erpapi_router_response')->set_channel_id($wms_id)->set_api_name('wms.reship.status_update')->dispatch($data);
    }
}

?>
