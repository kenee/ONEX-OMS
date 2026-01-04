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
/**
 * Created by PhpStorm.
 * User: ghc
 * Date: 18/11/20
 * Time: 上午11:32
 */
class erpapi_shop_matrix_weimobr_request_delivery extends erpapi_shop_request_delivery
{
    /**
     * 发货请求参数
     *
     * @return void
     * @author
     **/

    public function get_confirm_params($sdf)
    {
        $param = parent::get_confirm_params($sdf);
        //订单需要拆单
        if($sdf['is_split']==1 && !empty($sdf['oid_list'])){
            $goods = array();
            foreach($sdf['delivery_items'] as $key => $object){
                $obj = array();
                $obj['item_id'] = $object['oid'];
                $obj['sku_id'] = $object['shop_goods_id'];
                $obj['sku_num'] = $object['number'];
                $goods[] = $obj;
            }
            $param['is_split'] = 1;
            $param['goods'] = json_encode($goods);
        }
        return $param;
    }


}