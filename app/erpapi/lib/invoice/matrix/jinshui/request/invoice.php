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
 * 金税电子发票业务
 */
class erpapi_invoice_matrix_jinshui_request_invoice extends erpapi_invoice_request_invoice
{
    protected function get_create_apiname()
    {
        return STORE_JINSHUI_INVOICE_FILE_CREATE;
    }
    
    /**
     * 获取_result_apiname
     * @param mixed $sdf sdf
     * @return mixed 返回结果
     */

    public function get_result_apiname($sdf)
    {
        return $sdf['serial_no'] ? STORE_JINSHUI_INVOICE_RESULT_QUERY : STORE_JINSHUI_INVOICE_QUERY;
    }
}