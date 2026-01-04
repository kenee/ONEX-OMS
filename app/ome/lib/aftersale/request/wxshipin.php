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

class ome_aftersale_request_wxshipin extends ome_aftersale_abstract{


    /**
     * __construct
     * @return mixed 返回值
     */
    public function __construct()
    {
        $this->_render = app::get('ome')->render();
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
        $rs = array('rsp'=>'succ','msg'=>'','data'=>'');
        $return_id = $data['return_id'];
        $status = $data['status'];

        // 只有接收申请和拒绝才发起请求
        $allowStatusList = [ '5','3'];
        
        if(!in_array($status,$allowStatusList) && $data['return_type']=='change'){
            return $rs;
        }

        if($status == '3'){
            $rsp = kernel::single('ome_service_aftersale')->update_status($return_id,'6','sync');
        }

        if($status == '5'){
            $rsp = kernel::single('ome_service_aftersale')->update_status($return_id,'9','sync');
        }

        if ($rsp && $rsp['rsp'] == 'fail') {
            $rs['rsp'] = 'fail';
            $rs['msg'] = $rsp['msg'];
        }
        
        return $rs;
    }

   
}
?>
