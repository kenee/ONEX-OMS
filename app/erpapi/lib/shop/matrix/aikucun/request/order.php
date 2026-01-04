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
/**
 * Created by PhpStorm.
 * User: qiudi
 * Date: 18/10/10
 * Time: 上午10:50
 */
class erpapi_shop_matrix_aikucun_request_order extends erpapi_shop_request_order
{
    /**
     * __forma_params_get_order_detial
     * @param mixed $params 参数
     * @return mixed 返回值
     */

    public function __forma_params_get_order_detial($params)
    {
        $params['version'] = '2.0';
        return $params;
    }
}