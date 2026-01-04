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

class erpapi_shop_matrix_shopex_penkrwd_response_refund extends erpapi_shop_matrix_shopex_response_refund {

    //全民分销未生成退款单前允许编辑
    /**
     * _formatAddParams
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function _formatAddParams($params) {
        $sdf=parent::_formatAddParams($params);
        if($sdf['status']!='4') {
            $sdf['refund_version_change'] = true;
        }
        return $sdf;
    }

    /**
     * 添加
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function add($params) {
        $sdf=parent::add($params);
        if ($sdf['order']['ship_status']) {
            $sdf['refund_refer']=in_array($sdf['order']['ship_status'],array('1','3')) ? '1' : '0';
        }
        return $sdf;
    }
}