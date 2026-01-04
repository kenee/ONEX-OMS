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
 * @desc 售后单数据验证
 * @author: jintao
 * @since: 2016/7/21
 */
class erpapi_shop_response_params_aftersale extends erpapi_shop_response_params_abstract {

    protected function add() {
        $arr = array(
            'status' => array(
                'required' => 'true',
                'errmsg' => '售后状态不能为空'
            ),
            'order' => array(
                'type' => 'array',
                'col' => array(
                    'ship_status' => array(
                        'type' => 'enum',
                        'in_out' => 'out',
                        'value' => array('0', '4'),
                        'errmsg' => '订单未发货或已退货，不能申请'
                    )
                )
            ),
            'return_product_items' => array(
                'type' => 'array',
                'errmsg' => '售后商品格式不正确',
                'col' => array(
                    'product_id' => array(
                        'required' => 'true',
                        'errmsg' => '有商品被删除'
                    ),
                    'sendNum' => array(
                        'type' => 'method',
                        'method' => 'validAddSendNum',
                        'errmsg' => '退货商品超过了已发货商品'
                    )
                )
            )
        );
        return $arr;
    }

    protected function validAddSendNum($params) {
        if($params['sendNum'] < $params['num']) {
            return false;
        }
        return true;
    }

    protected function statusUpdate() {
        $arr = array(
            'status' => array(
                'required' => 'true',
                'errmsg' => '售后申请单状态不能为空',
            ),
            'return_bn' => array(
                'required' => 'true',
                'errmsg' => '售后申请单单号不能为空',
            ),
            'order_bn' => array(
                'required' => 'true',
                'errmsg' => '订单单号不能为空'
            )
        );
        return $arr;
    }

    protected function logisticsUpdate() {
        $arr = array(
            'return_bn' => array(
                'required' => 'true',
                'errmsg' => '售后申请单单号不能为空',
            ),
            'order_bn' => array(
                'required' => 'true',
                'errmsg' => '订单单号不能为空'
            ),
            'process_data' => array(
                'type' => 'array',
                'errmsg' => '缺少物流信息'
            )
        );
        return $arr;
    }
}