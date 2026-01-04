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
 * @author ykm 2015-12-15
 * @describe 应用级参数定义
 */
class erpapi_logistics_matrix_360buy_config extends erpapi_logistics_matrix_config{

    /**
     * 获取_query_params
     * @param mixed $method method
     * @param mixed $params 参数
     * @return mixed 返回结果
     */

    public function get_query_params($method, $params){
        $jdAccount = explode('|||',$this->__channelObj->channel['shop_id']);
        $jdObj = kernel::single('logisticsmanager_waybill_360buy');
        $shop = app::get('ome')->model('shop')->dump(array('shop_id'=>$jdAccount[1], 'node_id|noequal'=>'', 'node_type'=>['360buy','jd']), 'shop_id,node_type,node_id,addon');
        $addon = $shop['addon'];
        
        $query_params = array(
            'customerCode' => trim($jdAccount[0]), //客户号
            'businessType' => $jdObj->businessType($this->__channelObj->channel['logistics_code']), //单据类型
            'to_node_id' => $shop['node_id'],
            'node_type' => $shop['node_type'],
        );
        

        if($method == STORE_WAYBILL_STANDARD_TEMPLATE) {
            $query_params['cp_code'] = (string)$params['cp_code'];
        }

        $pqp = parent::get_query_params($method, $params);
        $query_params = array_merge((array)$pqp, (array)$query_params);

        return $query_params;
    }

    /**
     * 获取_to_node_id
     * @return mixed 返回结果
     */
    public function get_to_node_id()
    {
        $jdAccount = explode('|||',$this->__channelObj->channel['shop_id']);
        $shop = app::get('ome')->model('shop')->dump(array('shop_id'=>$jdAccount[1], 'node_id|noequal'=>'', 'node_type'=>'360buy'), 'node_id');

        return $shop['node_id'];
    }
}