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


class erpapi_shop_matrix_weidian_request_delivery extends erpapi_shop_request_delivery
{
    /**
     * 发货请求参数
     *
     * @return void
     * @author
     **/
    protected function get_confirm_params($sdf)
    {
        $param = parent::get_confirm_params($sdf);
        // 拆单子单回写
        if($sdf['is_split'] == 1&&$sdf['split_model']==1) {
            $param['is_split']  = $sdf['is_split'];
            $items=array();
            foreach ($sdf['delivery_items'] as $key => $arr){
                if($arr['item_type']=='pkg'){
                    $arr['shop_product_id'] = $arr['oid'];
                    if($arr['oid']==$arr['shop_goods_id']){
                        $arr['shop_product_id'] = null;
                    }
                }
                $items[]=array(
                    'item_id'=>$arr['shop_goods_id'],
                    'item_sku_id'=>$arr['shop_product_id'],
                );
            }
            $param['items'] = json_encode($items);
        }

        //虚拟发货
        if ($sdf['is_virtual']) {
            unset($param['company_code']);
            unset($param['company_name']);
            unset($param['logistics_no']);
        }

        return $param;
    }

    protected function get_delivery_apiname($sdf)
    {
        if($sdf['is_virtual']) {
            //虚拟发货
            return SHOP_LOGISTICS_DUMMY_SEND;
        }
        return SHOP_LOGISTICS_OFFLINE_SEND;
    }

}