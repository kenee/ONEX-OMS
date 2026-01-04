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
 * 美团医药订单
 */
class erpapi_shop_matrix_meituan4medicine_response_order extends erpapi_shop_response_order
{
    protected function get_update_components()
    {
        $components = array('markmemo', 'custommemo', 'marktype');
        
        //如果没有收货人信息
        if (!$this->_tgOrder['consignee']['name'] || !$this->_tgOrder['consignee']['addr'] || !$this->_tgOrder['consignee']['mobile']) {
            $components[] = 'consignee';
        }
        
        return $components;
    }
    
    protected function _analysis()
    {
        parent::_analysis();
        
        if ($this->_ordersdf['consignee']['telephone'] == '[]') {
            $this->_ordersdf['consignee']['telephone'] = '';
        }
    }
}