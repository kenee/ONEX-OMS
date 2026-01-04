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
 * @desc 退款单数据处理
 * @author: jintao
 * @since: 2016/7/21
 */
class erpapi_shop_matrix_shopex_bbc_response_refund extends erpapi_shop_matrix_shopex_response_refund {

    protected function _formatAddParams($params) {

        $field = 'ship_status';

        $tgOrder = $this->getOrder($field, $this->__channelObj->channel['shop_id'], $params['order_bn']);
        if ($tgOrder['ship_status'] == '1') {
            return array();
            exit;
        }
        $sdf = parent::_formatAddParams($params);
        $sdf['cod_zero_accept'] = true;
        return $sdf;
    }

}