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
 * User: qiudi
 * Date: 18/10/10
 * Time: 上午10:51
 */
class erpapi_shop_matrix_aikucun_response_order extends erpapi_shop_response_order{
    protected $_update_accept_dead_order = true;

    protected function get_update_components()
    {
        $components = array('markmemo','marktype','custommemo');

        if ( ($this->_ordersdf['shipping']['is_cod']=='true' && $this->_ordersdf['status'] == 'dead') || ($this->_ordersdf['shipping']['is_cod'] != 'true' && $this->_ordersdf['pay_status'] == '5'))
        {
            $components[] = 'master';
        }

        return $components;
    }

    protected function get_create_plugins()
    {
        $plugins = parent::get_create_plugins();

        $plugins[] = 'waybill';
        $plugins[] = 'orderextend';

        return $plugins;
    }

    protected function _analysis()
    {
        parent::_analysis();

        // 98代表商家自发
        if ($this->_ordersdf['shipping']['shipping_name'] == '98') {
            $this->_ordersdf['shipping']['shipping_name'] = '';
        }
    }

    /**
     * _canAccept
     * @return mixed 返回值
     */

    public function _canAccept()
    {
        

        if ($this->_ordersdf['consignee']['telephone'] == '分配中' || $this->_ordersdf['consignee']['mobile'] == '分配中'){
            $this->__apilog['result']['msg'] = '手机或电话 分配中不处理';
            return false;
        }

        return parent::_canAccept();
    }
}