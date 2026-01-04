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
 * @desc
 * @author: jintao
 * @since: 2016/7/20
 */
class erpapi_shop_matrix_yihaodian_response_aftersalev2 extends erpapi_shop_response_aftersalev2 {

    protected function _formatAddParams($params) {
        $sdf = parent::_formatAddParams($params);
        $yhdSdf = array(
            'sendbackaddress'=> $params['receiver_address'],
            'receive_state'=> $params['good_status'],
        );
        return array_merge($sdf, $yhdSdf);
    }

    protected function _getAddType($sdf) {
        return 'returnProduct';
    }

    protected function _formatAddItemList($sdf, $convert = array()) {
        $convert = array(
            'sdf_field'=>'oid',
            'order_field'=>'oid',
            'default_field'=>'outer_id'
        );
        return parent::_formatAddItemList($sdf, $convert);
    }

    protected function _returnProductAdditional($sdf) {
        $ret = array(
            'model' => 'return_product_yihaodian',
            'data' => array(
                'shop_id'         => $sdf['shop_id'],
                'sendbackaddress'=> $sdf['sendbackaddress'],
                'receive_state'=> $sdf['receive_state'],
            )
        );
        return $ret;
    }
}