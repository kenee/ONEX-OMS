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

class ome_aftersale_request_websited1m extends ome_aftersale_abstract
{
    /**
     * __construct
     * @return mixed 返回值
     */
    public function __construct()
    {
        $this->_render = app::get('ome')->render();
    }
    
    /**
     * 退款状态保存前扩展
     * @param data msg
     * @return
     * @access  public
     * @author
     */
    function pre_save_refund($apply_id, $data)
    {
        set_time_limit(0);
        
        $oRefund_apply = app::get('ome')->model('refund_apply');
        
        $refunddata = $oRefund_apply->refund_apply_detail($apply_id);
        if ($data['status'] == '2' || $data['status'] == '3') {
            $result = kernel::single('ome_service_refund_apply')->update_status($refunddata, $data['status'], 'sync');
            return $result;
        }
    }
}