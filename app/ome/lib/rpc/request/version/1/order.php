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


class ome_rpc_request_version_1_order extends ome_rpc_request_version_base_order {

    /**
    * 订单编辑 iframe
    * @access public
    * @param Array $params 请求参数
    * @return Array
    */
    public function update_iframe($params){
        $data = array('edit_type'=>'local');
        return array('rsp'=>'success','msg'=>'本地订单编辑','data'=>$data);
    }
}