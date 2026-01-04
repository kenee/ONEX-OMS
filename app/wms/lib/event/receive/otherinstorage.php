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


class wms_event_receive_otherinstorage extends wms_event_response{

    /**
     * 其他入库操作后变更其他入单状态
     */
    public function setStatus(){

    }

    public function create($data){
        #error_log('other:'.var_export($data,1),3,__FILE__.".log");
        return $this->send_succ();
    }

    public function updateStatus($data){
        return $this->send_succ();
    }
}

?>
