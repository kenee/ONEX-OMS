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
class erpapi_shop_matrix_wdwd_request_delivery extends erpapi_shop_request_delivery
{
	protected function get_confirm_params($sdf){
        $param = parent::get_confirm_params($sdf);
        #属于拆单
        if($sdf['is_split'] == 2){
            $param['is_split'] =  1;
        }else{
            $param['is_split'] = 0;
        }
        $item_list = array();
        $object = array();
        $bns = array();
        $ralation_bn = array();
        #货号和oid一一对应
        foreach((array) $sdf['orderinfo']['order_objects'] as $object){
            $ralation_bn[$object['bn']] = $object['oid'];
        }
        foreach ((array) $sdf['delivery_items'] as $item) {
            $item_list[] = array(
                'oid'          => $ralation_bn[$item['bn']],
                'num'          => (int)$item['number']
            );
        }
        $param['item_list'] = json_encode($item_list);
        return $param;
    } 
}