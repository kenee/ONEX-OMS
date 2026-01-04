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
 * @desc
 * @author: jintao
 * @since: 2016/7/21
 */
class erpapi_shop_matrix_shopex_response_refund extends erpapi_shop_response_refund {

    protected function _formatAddParams($params) {
        $sdf = parent::_formatAddParams($params);
        $sdf['t_ready']    = $params['t_ready'];
        $sdf['t_sent']     = $params['modified'];
        $sdf['t_received'] = '';    // 如果是c2c订单不设用户收款时间
        return $sdf;
    }
}