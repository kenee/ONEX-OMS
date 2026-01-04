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
 * 华为商城平台对接
 * 
 * @author wangbiao@shopex.cn
 * @version $Id: Z
 */
class erpapi_shop_matrix_huawei_request_aftersale extends erpapi_shop_request_aftersale
{
    /***
    protected function __afterSaleApi($status, $returnInfo=null)
    {
        switch($status)
        {
            case '3':
                $api_method = SHOP_AGREE_RETURN_GOOD;
                break;
            case '5':
                $api_method = SHOP_REFUSE_RETURN_GOOD;
                break;
            default :
                $api_method = '';
                break;
        }
        
        return $api_method;
    }
    ***/
}