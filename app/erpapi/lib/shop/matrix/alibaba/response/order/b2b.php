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
 * 
 *
 * @category 
 * @package 
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_shop_matrix_alibaba_response_order_b2b extends erpapi_shop_matrix_alibaba_response_order
{
    protected function get_create_plugins()
    {
        $plugins = parent::get_create_plugins();

        $plugins[] = 'sellingagent';

        return $plugins;
    }

    protected function get_update_plugins()
    {
        $plugins = parent::get_update_plugins();

        $plugins[] = 'sellingagent';

        return $plugins;
    }

    protected function _analysis()
    {
        parent::_analysis();

        foreach($this->_ordersdf['selling_agent'] as $k=>$v){
            if($k == 'agent'){
                $this->_ordersdf['selling_agent']['member_info'] = $this->_ordersdf['selling_agent']['agent'];
                unset($this->_ordersdf['selling_agent']['agent']);
            }
        }
    }

    protected function get_update_components()
    {
        $components = parent::get_update_components();

        // 到付取消
        if ( ($this->_ordersdf['shipping']['is_cod'] == 'true' && $this->_ordersdf['status'] == 'dead') 
                || ($this->_ordersdf['shipping']['is_cod'] != 'true' && $this->_ordersdf['total_amount'] != $this->_ordersdf['payed'])
            ) {
            $components[] = 'master';
        }

        return $components;
    }
}
