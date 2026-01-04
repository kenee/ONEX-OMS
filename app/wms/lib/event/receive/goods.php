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

class wms_event_receive_goods extends wms_event_response{

    /**
     * 商品通知单创建事件
     * @param array $data
     */
    public function create($data){
        
        
        $new_tag = '1';
        $sync_status = '3';
        
        kernel::single('console_foreignsku')->batch_syncupdate($data['wms_id'],$new_tag,$sync_status,$bns);
        return $this->send_succ();
    }

    /**
     * 商品通知单状态变更事件
     * @param array $data
     */
    public function updateStatus($data){
        

        $new_tag = '1';
        $sync_status = '3';
        kernel::single('console_foreignsku')->batch_syncupdate($wms_id,$new_tag,$sync_status,$bns);
        return $this->send_succ();;
    }

}
