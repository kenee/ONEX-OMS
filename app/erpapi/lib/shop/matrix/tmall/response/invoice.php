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
 * 自助开发票
 *
 * @author wangbiao<wangbiao@shopex.cn>
 * @version 0.1
 */
class erpapi_shop_matrix_tmall_response_invoice extends erpapi_shop_response_invoice
{
    /**
     * 获取数据
     * 
     * @param array $params
     * @return array:
     */

    protected function _returnParams($params) {
        $sdf = $this->_formatParams($params);
        
        return $sdf;
    }
}
