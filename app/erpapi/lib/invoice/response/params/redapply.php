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
 * 红字确认单参数验证
 *
 */
class erpapi_invoice_response_params_redapply extends erpapi_invoice_response_params_abstract
{
    /**
     * 发货单更新校验参数
     *
     * @return void
     * @author
     **/

    public function status_update()
    {
        $params = array (
            'status'           => array ('required' => 'true', 'type' => 'int', 'errmsg' => '状态必填'),
            'invoice_apply_bn' => array ('required' => 'true', 'type' => 'string', 'errmsg' => '流水号必填'),
            'id'               => array ('required' => 'true', 'type' => 'string', 'errmsg' => '发票id必填'),
            'item_id'          => array ('required' => 'true', 'type' => 'string', 'errmsg' => '明细id必填'),
        );
        return $params;
    }

}
