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
 * @desc beibei售后数据转换
 * @author: jintao
 * @since: 2016/7/20
 */
class erpapi_shop_matrxi_beibei_response_aftersalev2 extends erpapi_shop_response_aftersalev2
{
    protected function _getAddType($sdf) {
        if(in_array($sdf['order']['ship_status'],array('0'))) { #退款
            return 'refund';
        } else { #退货
            return 'returnProduct';
        }
    }

    protected function _formatAddItemList($sdf, $convert = array()) {
        $convert = array(
            'sdf_field'=>'item_id',
            'order_field'=>'shop_goods_id',
            'default_field'=>'outer_id'
        );
        return parent::_formatAddItemList($sdf, $convert);
    }

}