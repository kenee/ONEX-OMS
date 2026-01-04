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

class erpapi_shop_matrix_meituan4bulkpurchasing_response_aftersalev2 extends erpapi_shop_response_aftersalev2
{
    protected function _formatAddParams($params)
    {
        $sdf = parent::_formatAddParams($params);
        if (in_array($sdf['refund_type'], array('refund', 'apply'))) {
            //售前售后报错退款明细
            if (empty($sdf['refund_item_list']) || empty($sdf['refund_item_list']['return_item'])) {
                $sdf['refund_item_list'] = array(1);
            }
        }
        return $sdf;
    }
    
    protected function _getAddType($sdf)
    {
        //需要退货才更新为售后单
        if ($sdf['has_good_return'] == 'true') {
            if (in_array($sdf['order']['ship_status'],array('0'))) {
                //有退货，未发货的,做退款
                return 'refund';
            } else{
                //有退货，已发货的,做售后
                return 'returnProduct';
            }
        }else{
            //无退货的，直接退款
            return 'refund';
        }
    }
    
    protected function _formatAddItemList($sdf, $convert = array())
    {
        $convert = array(
            'sdf_field'     => 'oid',
            'order_field'   => 'oid',
            'default_field' => 'outer_id'
        );
        return parent::_formatAddItemList($sdf, $convert);
    }
}