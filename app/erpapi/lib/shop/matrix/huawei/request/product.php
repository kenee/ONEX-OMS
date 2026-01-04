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
class erpapi_shop_matrix_huawei_request_product extends erpapi_shop_request_product
{
    //根据IID获取单个商品
    /**
     * item_get
     * @param mixed $iid ID
     * @return mixed 返回值
     */

    public function item_get($iid)
    {
        $title = '单拉商品[' . $iid . ']';
        
        $params = array(
            'product_id' => $iid,
        );
        
        //失败重试3次
        for ($i=0; $i<3; $i++)
        {
            $result = $this->__caller->call(SHOP_ITEM_GET, $params, array(), $title, 20, $iid);
            if ($result['rsp'] == 'succ') break;
        }
        
        //empty
        if ($result['rsp'] != 'succ' || empty($result['data'])){
            return array();
        }
        
        //json_decode
        if ($result['data']){
            $result['data'] = @json_decode($result['data'],true);
        }
        
        return $result;
    }
}
