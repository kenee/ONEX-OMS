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
 * @author 20180829 by wangjianjun
 * @describe 售后数据转换
 */

class erpapi_shop_matrix_kaola_response_aftersalev2 extends erpapi_shop_response_aftersalev2 {
    
    protected function _getAddType($sdf){
        if($sdf['refund_type'] == 'return'){
            return 'returnProduct';
        }else{
            return 'refund';
        }
    }
    
    protected function _formatAddItemList($sdf, $convert=array()){
        if($sdf['refund_type'] == 'refund') {
            return array();
        }
        $convert = array(
                'sdf_field'=>'oid',
                'order_field'=>'oid',
                'default_field'=>'outer_id'
        );
        return parent::_formatAddItemList($sdf, $convert);
    }
    
    protected function _refundAddSdf($sdf){
        $sdf['shop_type'] = 'kaola';
        if(self::$refund_status[strtoupper($sdf['status'])] != '4') {
            $sdf['refund_type'] = 'apply';
        }
        $sdf = parent::_refundAddSdf($sdf);
        return $sdf;
    }
    
}