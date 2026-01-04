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

class erpapi_format_json extends erpapi_format_abstract{
    
    /**
     * data_encode
     * @param mixed $data 数据
     * @return mixed 返回值
     */
    public function data_encode($data){
        // qimen接口返回数据
        if(in_array($_REQUEST['method'], ['qimen.taobao.erp.order.add', 'qimen.taobao.erp.order.update'])){
            $qimenResult = [
                'flag' => 'failure',
                'code' => '0',
                'message' => '',
            ];
            
            // succ
            if($data['rsp'] == 'succ' || $data['rsp'] == 'success'){
                $qimenResult['flag'] = 'success';
            }
            
            // msg_code
            if(isset($data['msg_code'])){
                $qimenResult['code'] = $data['msg_code'];
            }
            
            // message
            if(isset($data['msg']) || isset($data['message'])){
                $qimenResult['message'] = ($data['msg'] ? $data['msg'] : $data['message']);
            }
            
            // data
            if(isset($data['data'])){
                $qimenResult['data'] = $data['data'];
            }
            
            // 重置
            $data = $qimenResult;
        }
        
        return json_encode($data);
     }

    /**
     * data_decode
     * @param mixed $data 数据
     * @return mixed 返回值
     */
    public function data_decode($data){
        return json_decode($data,true);
     }
}