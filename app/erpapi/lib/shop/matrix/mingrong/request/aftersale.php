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
 * Created by PhpStorm.
 * User: yaokangming
 * Date: 2019/2/21
 * Time: 17:24
 */

class erpapi_shop_matrix_mingrong_request_aftersale extends erpapi_shop_request_aftersale
{

    protected function _formatConsignGoodsParams($data)
    {
        $params = parent::_formatConsignGoodsParams($data);
        $params['sku_info'] = json_encode(array(array('bn'=>$data['sku_bn'])));
        return $params;
    }
    protected function __afterSaleApi($status, $returnInfo=null) {
        switch( $status ){
            case '3':
                if($returnInfo['kinds'] == 'change') {
                    $api_method = SHOP_AGREE_CHANGE_I_GOOD_TMALL;
                } else {
                    $api_method = SHOP_AGREE_RETURN_GOOD;
                }
                break;
            case '5':
                if($returnInfo['kinds'] == 'change') {
                    $api_method = SHOP_REFUSE_CHANGE_I_GOOD_TMALL;
                } else {
                    $api_method = SHOP_REFUSE_RETURN_GOOD;
                }
                break;
            default :
                $api_method = '';
                break;
        }
        return $api_method;
    }

    protected function __formatAfterSaleParams($aftersale,$status) {
        $userName = kernel::single('desktop_user')->get_name();
        if($aftersale['kinds'] == 'change') {
            $params = array(
                'dispute_id'=>$aftersale['return_bn'],
                'leave_message' => $userName . 'ERP操作',  # 审核意见
            );
        } else {
            $params = array(
                'refund_id'=>$aftersale['return_bn'],
                'description' => $userName . 'ERP操作',  # 审核意见
            );
        }
        return $params;
    }
}