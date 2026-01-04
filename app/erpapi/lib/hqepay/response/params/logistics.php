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

class erpapi_hqepay_response_params_logistics extends erpapi_hqepay_response_params_abstract {

    protected function push(){
        return array(
            'logi_status' => array(
                'type'=> 'enum',
                'required' => 'true',
                'errmsg' => '只接受已揽收或已签收物流信息',
                'value' => array('1','2','3','4','5','6')
            ),
            'logi_no' => array(
                'required' => 'true',
                'errmsg' => '缺少物流单号不接收！'
            ),
            'delivery_id' => array(
                'required' => 'true',
                'errmsg' => '该物流状态签已处理过或不存在,不接受！'
            ),

        );
    }
}