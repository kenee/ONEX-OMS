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

class ome_aftersale_request_shopex extends ome_aftersale_abstract{

    function show_aftersale_html(){
        
        $html = '';
        return $html;
    }

    function refund_button($apply_id,$status)
    {
        $shop_id = $this->_shop['shop_id'];

        $rs = array('rsp'=>'default','msg'=>'succ','data'=>'');
        if ($status == '3' && (($this->_shop['api_version']>=3 && $this->_shop['node_type'] == 'ecos.b2c') || $this->_shop['node_type'] == 'ecos.ecshopx')) {
            $rs = array('rsp'=>'show','msg'=>'','data'=>'index.php?app=ome&ctl=admin_refund_apply&act=upload_refuse_message&p[0]='.$apply_id.'&p[1]=ecstore');
        }
        return $rs;
    }
    
    /**
     * 退款状态保存前扩展 , 当前平台用于传输CRC本地退款申请单
     *
     * @param int $apply_id
     * @param array $data status=2 接收申请 ;  status=3 拒绝
     * @return array
     */
    function pre_save_refund($apply_id, $data)
    {
        set_time_limit(0);
        $oRefund_apply = app::get('ome')->model('refund_apply');
        $refunddata    = $oRefund_apply->refund_apply_detail($apply_id);
        
        $rs = array('rsp' => 'succ', 'msg' => '', 'data' => '');
        
        // 只有接收申请和拒绝才发起请求
        if (!in_array($data['status'], ['2', '3'])) {
            return $rs;
        }
        
        if ($refunddata['source'] != 'matrix') {
            return $rs;
        }
        
        $result = kernel::single('ome_service_refund_apply')->update_status($refunddata, $data['status'], 'sync');
        return $result;
    }
    
    
    /**
     * 售后保存前的扩展
     *
     * @param array $data
     * @return array
     */
    function pre_save_return($data)
    {
        set_time_limit(0);
        $rs        = array('rsp' => 'succ', 'msg' => '', 'data' => '');
        $return_id = $data['return_id'];
        $status    = $data['status'];
        
        // 只有接收申请和拒绝才发起请求
        $allowStatusList = ['3', '5'];
        
        if (!in_array($status, $allowStatusList)) {
            return $rs;
        }
        
        // 接受申请需选择转换类型,且类型为退货单
        if ($status == '3' && (!isset($data['choose_type']) || $data['choose_type'] != '1')) {
            return $rs;
        }
        
        $rsp = kernel::single('ome_service_aftersale')->update_status($return_id, $status, 'sync');
        if ($rsp && $rsp['rsp'] == 'fail') {
            $rs['rsp'] = 'fail';
            $rs['msg'] = $rsp['msg'];
        }
        
        return $rs;
    }
}
?>