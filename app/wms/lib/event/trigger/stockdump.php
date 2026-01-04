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

class wms_event_trigger_stockdump{

    /**
     *
     * 转储单确认发起方法
     * @param array $po_bn 采购单唯一标识
     * @param string $sync 是否同步请求，true为同步，false异步，默认异步
     */
    public function inStorage($wms_id, $data, $sync = false){
        
        //$result = kernel::single('middleware_wms_response', $wms_id)->stockin_result($data);
        $result = kernel::single('erpapi_router_response')->set_channel_id($wms_id)->set_api_name('wms.stockdump.status_update')->dispatch($data);
    }

    /**
     *
     * 采购入库事件发起的响应接收方法
     * @param string $po_bn
     */
    public function inStorage_callback($res){

    }

}

?>
