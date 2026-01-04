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
 * 发货单处理
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_shop_matrix_amazon_request_delivery extends erpapi_shop_request_delivery
{

    /**
     * confirm
     * @param mixed $sdf sdf
     * @param mixed $queue queue
     * @return mixed 返回值
     */

    public function confirm($sdf,$queue=false)
    {
        if ('false' == $sdf['orderinfo']['self_delivery']) return $this->succ('亚马逊自发货无需回写状态');

        return parent::confirm($sdf,$queue);
    }


    /**
     * 发货请求参数
     *
     * @return void
     * @author 
     **/
    protected function get_confirm_params($sdf)
    {
        $param = parent::get_confirm_params($sdf);

        $item_list = array();
        foreach ((array) $sdf['delivery_items'] as $item) {
            if ($item['shop_goods_id']) {
                $item_list[] = array(
                    'oid'    => $sdf['orderinfo']['order_bn'],
                    'itemId' => $item['shop_goods_id'],
                    'num'    => $item['number'],
                );
            }
        }
        
        $param['item_list'] = json_encode($item_list);

        return $param;
    }
}