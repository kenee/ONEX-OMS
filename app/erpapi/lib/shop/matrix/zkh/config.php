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

class erpapi_shop_matrix_zkh_config extends erpapi_shop_config
{
    /**
     * 获取请求地址
     * @param String $method
     * @param array $params
     * @param bool $realtime
     * @return string|void
     * @author db
     * @date 2023-10-10 6:26 下午
     */
    public function get_url($method, $params, $realtime)
    {
        $url = MATRIX_GO_URL;
        if ($realtime == true) {
            $url .= 'sync';
        } else {
            $url .= 'async';
        }
        return $url;
    }
}