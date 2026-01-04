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
 * WMS 发货单参数验证
 *
 */
class erpapi_wms_response_params_receiverinfo extends erpapi_validate
{

    /**
     * query
     * @return mixed 返回值
     */

    public function query()
    {
        $params = array(
            'delivery_bn' => array('required'=>'true', 'type'=>'string','errmsg'=>'发货单号必填'),
        );
        return $params;
    }

}