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

class erpapi_shop_matrix_pos_result extends erpapi_result {

    /**
     * 设置_response
     * @param mixed $response response
     * @param mixed $format format
     * @return mixed 返回操作结果
     */
    public function set_response($response, $format)
    {

        $response = kernel::single('erpapi_format_' . $format)->data_decode($response);
        // $result = $response['result'];

        $this->response = [
            'msg_id'  => $response['catId'],
            'rsp'     => $response['code'] == '10000' ? 'succ' : 'fail',
            'data'    => $response['data'],
            'res'     => '',
            'err_msg' => $response['message'],
        ];

        
        return $this;
    }

}
