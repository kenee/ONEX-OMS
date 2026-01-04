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
 * ============================
 * @Author:   yaokangming
 * @Version:  1.0 
 * @DateTime: 2022/7/7 18:24:44
 * @describe: 类
 * ============================
 */

class erpapi_shop_matrix_tmall_response_maochao_aftersalev2 extends erpapi_shop_matrix_tmall_response_aftersalev2
{
    protected function _formatAddParams($params) {
        $sdf = parent::_formatAddParams($params);
        $extend_field = json_decode($sdf['extend_field'], 1);
        if(is_array($sdf['refund_item_list'])) {
            $itemList = $sdf['refund_item_list']['return_item'];
            foreach ($itemList as $key => $value) {
                $extend_field['items'][$value['item_id']] = $value['oid'];
            }
        }
        $sdf['extend_field'] = json_encode($extend_field, JSON_UNESCAPED_UNICODE);
        return $sdf;
    }

    protected function _formatAddItemList($sdf, $convert = array()) {
        $convert = array(
            'sdf_field'=>'item_id',
            'order_field'=>'shop_goods_id',
            'default_field'=>'item_id'
        );
        return parent::_formatAddItemList($sdf, $convert);
    }
}
