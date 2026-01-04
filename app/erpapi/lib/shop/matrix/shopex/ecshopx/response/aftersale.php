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

class erpapi_shop_matrix_shopex_ecshopx_response_aftersale extends erpapi_shop_response_aftersale
{
    protected function _formatAddParams($params) {
        $sdf=parent::_formatAddParams($params);
        $shopId = $this->__channelObj->channel['shop_id'];
        $returnModel = app::get('ome')->model('return_product');
        $tgReturn = $returnModel->getList('return_id', array('shop_id'=>$shopId,'return_bn'=>$sdf['return_bn']));
        if($tgReturn) {
            $sdf['action'] = 'update';
            $sdf['return_id'] = $tgReturn[0]['return_id'];
        }
        if($sdf['status']=='1'||$sdf['status']=='5') {
            $sdf['refund_version_change'] = true;
        }
        return $sdf;
    }
    
    protected function _checkeditAftersale($tgReturn,$refund_version_change) {
        if($tgReturn&&$refund_version_change==true){
            return false;
        }else{
            return $tgReturn;
        }
    }
}
