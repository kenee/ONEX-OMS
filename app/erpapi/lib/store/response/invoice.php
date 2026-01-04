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

class erpapi_store_response_invoice extends erpapi_store_response_abstract
{
    

    /**
     * 
     * @param  $params [参数] method store.invoice.invoice
     * @return array
     */
    public function add($params){
        $this->__apilog['title']       = $this->__channelObj->store['name'].'订单开票';
        $this->__apilog['original_bn'] = $params['tid'];

        if (empty($params['tid'])) {

            $this->__apilog['result']['msg'] = "订单号不可为空";
            return false;
        }
        $store_bn = $params['store_bn'];

        if (empty($store_bn)) {

            $this->__apilog['result']['msg'] = "下单门店编码不可以为空";
            return false;
        }

        $shops_detail = app::get('ome')->model('shop')->dump(array('shop_bn' => $store_bn));
        if (!$shops_detail) {
            $this->__apilog['result']['msg'] = $store_bn . ":门店不存在";
            return false;
        }
        //判断是否存在
        
        $data = array(
            'tid'           =>  $params['tid'],
            'invoice_kind'  =>  $params['invoice_kind'],
            'invoice_attr'  =>  $params['invoice_attr'],
            'company_title' =>  $params['company_title'],
            'register_no'   =>  $params['register_no'],
            'invoice_amount'=>  $params['invoice_amount'],
            'extend_arg'    =>  $params['extend_arg'],
        );
        $data['shop_type'] = $shops_detail['node_type'];
        $data['node_id']   = $shops_detail['node_id'];
        return $data;
    }

}

?>