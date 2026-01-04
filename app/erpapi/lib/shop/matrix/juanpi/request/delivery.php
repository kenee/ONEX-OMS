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
/**
 * 发货单处理
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_shop_matrix_juanpi_request_delivery extends erpapi_shop_request_delivery
{
    /**
     * 发货回调
     *
     * @return void
     * @author 
     **/

    public function confirm_callback($response, $callback_params)
    {
        if ($response['err_msg']) {
            $err_msg = @json_decode($response['err_msg'],true);
            if ($err_msg['info'] == '10015' && $err_msg['status'] == '0') {
                $response['res'] = 'W90012';
            }
        }

        return parent::confirm_callback($response, $callback_params);
    }
}