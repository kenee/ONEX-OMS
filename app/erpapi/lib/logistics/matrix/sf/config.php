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
 * @author ykm 2015-12-15
 * @describe 应用级参数定义
 */
class erpapi_logistics_matrix_sf_config extends erpapi_logistics_matrix_config{
    protected $_to_node_id = '1588336732';
    /**
     * 获取_query_params
     * @param mixed $method method
     * @param mixed $params 参数
     * @return mixed 返回结果
     */

    public function get_query_params($method, $params){
        $sfAccount = explode('|||',$this->__channelObj->channel['shop_id']);
        $sfObj = kernel::single('logisticsmanager_waybill_sf');
        $query_params = array(
            'sysAccount' => $sfAccount[0],
            'passWord' => $sfAccount[1],
            'pay_method'=>$sfAccount[2],
            'custid' => $sfAccount[3],//月卡号
            'businessType' => $sfObj->getbusinessType($this->__channelObj->channel['logistics_code']), //单据类型
            'to_node_id' => $this->_to_node_id,
            'node_type' => 'sf',
        );
        $pqp = parent::get_query_params($method, $params);
        $query_params = array_merge($pqp, $query_params);

        return $query_params;
    }
}