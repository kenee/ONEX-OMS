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
 * @author ykm 2018/4/12
 * @describe 售后相关
 */

class erpapi_shop_matrix_shunguang_request_aftersale extends erpapi_shop_request_aftersale
{

    protected function __afterSaleApi($status, $returnInfo=null) {
        $apiName = '';
        if(in_array($status, array('3', '5'))) {
            $apiName = SHOP_ADD_REFUND_RPC;
        }
        return $apiName;
    }

    protected function __formatAfterSaleParams($aftersale, $status){
        $sdf = array(
            'refund_id' => $aftersale['return_bn'],
            'agree' => $status == '3' ? 1 : ($status == '5' ? 2 : ''),
            'handle_remark' => kernel::single('desktop_user')->get_name() . '操作,' . $aftersale['refuse_message']
        );
        return $sdf;
    }
}