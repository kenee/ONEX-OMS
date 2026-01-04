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
 * @author ykm 2016/5/30
 * @describe 淘宝退款单数据处理（已弃用）
 */

class erpapi_shop_matrix_taobao_response_refund extends erpapi_shop_response_refund {

    protected function _formatAddParams($params) {
        $this->__apilog['result']['msg'] = '淘宝退款单不走此接口';
        return array();
    }
}