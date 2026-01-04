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
 * @author ykm 2018/4/12
 * @describe 发货处理
 */
class erpapi_shop_matrix_shunguang_request_delivery extends erpapi_shop_request_delivery
{
    /**
     * confirm
     * @param mixed $sdf sdf
     * @param mixed $queue queue
     * @return mixed 返回值
     */

    public function confirm($sdf,$queue=false)
    {
        $hadRequestOid = array();
        $requestSdf = $sdf;
        foreach($sdf['orderinfo']['order_objects'] as $value) {
            if(!in_array($value['oid'], $hadRequestOid)) {
                $hadRequestOid[] = $value['oid'];
                $requestSdf['oid'] = $value['oid'];
                $result = parent::confirm($requestSdf, $queue);
            }
        }
        return $result;
    }

    protected function get_confirm_params($sdf)
    {
        $param = parent::get_confirm_params($sdf);
        $param['oid'] = $sdf['oid'];
        $param['send_type'] = '2';
        return $param;
    }
}