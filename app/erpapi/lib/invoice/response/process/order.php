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
 * 发票信息回传
 *
 */
class erpapi_invoice_response_process_order
{

    /**
     * status_update
     * @param mixed $params 参数
     * @return mixed 返回值
     */

    public function status_update($params)
    {
        $row = current($params);
        // 单独实例,避免缓存
        $constructParams = [
            'invoice_apply_bn' => $row['invoice_apply_bn'],
        ];

        $result = kernel::single('invoice_event_receive_invoice', $constructParams)->update($params);

        return $result;
    }

}
