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
 * 发货单处理
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_shop_matrix_shopex_485_request_v2_delivery extends erpapi_shop_matrix_shopex_request_delivery
{
    /**
     * 添加发货单参数
     *
     * @return void
     * @author 
     **/

    protected function get_add_params($sdf)
    {
        $param = parent::get_add_params($sdf);

        $delivery_items = array();
        foreach ($sdf['orderinfo']['order_objects'] as $object) {
            if($object['shop_goods_id'] && $object['shop_goods_id'] > 0){
                $delivery_items[] = array(
                    'name'   => $object['name'],
                    'bn'     => $object['bn'],
                    'number' => $object['quantity'],
                );
            }


        }

        $param['shipping_items'] = json_encode($delivery_items);

        return $param;
    }
}