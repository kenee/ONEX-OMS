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

class ome_aftersale_request_shunguang extends ome_aftersale_abstract{
    function show_aftersale_html(){

        $html = '';
        return $html;
    }
    function pre_save_refund($apply_id,$data){
        $oRefund_apply = app::get('ome')->model('refund_apply');
        $refunddata = $oRefund_apply->refund_apply_detail($apply_id);
        $result = kernel::single('ome_service_refund_apply')->update_status($refunddata,$data['status'],'sync');
        return $result;
    }

    function pre_save_return($data){
        set_time_limit(0);
        $rs = array('rsp'=>'succ','msg'=>'','data'=>'');
        $return_id = $data['return_id'];
        $rsp = kernel::single('ome_service_aftersale')->update_status($return_id,$data['status'],'sync');
        if ($rsp  && $rsp['rsp'] == 'fail') {
            $rs['rsp'] = 'fail';
            $rs['msg'] = $rsp['msg'];
        }
        return $rs;
    }
}