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
 * 京东分销 or 代销平台
 *
 * @author wangbiao<wangbiao@shopex.cn>
 * @version $Id: Z
 */
class erpapi_shop_matrix_360buy_response_order_b2b extends erpapi_shop_matrix_360buy_response_order
{
    /**
     * 是否接收订单
     * 
     * @return bool
     * */

    protected function _canAccept()
    {
        if ($this->__channelObj->channel['business_type'] == 'dx'){
            if($this->_ordersdf['order_source'] != 'jdjx'){
                $this->__apilog['result']['msg'] = '京东代销平台的订单标识不正确,不接收!';
                return false;
            }
        }else{
            $this->__apilog['result']['msg'] = '不是京东代销订单,不接收!';
            return false;
        }
        
        //parent
        return parent::_canAccept();
    }
    
    /**
     * 接收订单数据
     * 
     * @return void
     */
    protected function _analysis()
    {
        parent::_analysis();
        
        //接收分销商信息
        if($this->_ordersdf['selling_agent'] && is_string($this->_ordersdf['selling_agent'])){
            $this->_ordersdf['selling_agent'] = json_decode($this->_ordersdf['selling_agent'],true);
        }
        
        if($this->_ordersdf['selling_agent']){
            foreach((array)$this->_ordersdf['selling_agent'] as $k=>$v){
                if($k == 'agent'){
                    $this->_ordersdf['selling_agent']['member_info'] = $this->_ordersdf['selling_agent']['agent'];
                    unset($this->_ordersdf['selling_agent']['agent']);
                }
            }
        }
    }
    
    /**
     * 创建订单的插件
     * 
     * @return array
     */
    protected function get_create_plugins()
    {
        $plugins = parent::get_create_plugins();
        
        //分销商信息插件
        $plugins[] = 'sellingagent';
        
        //分销金额插件
        $plugins[] = 'tbfx';
        
        return $plugins;
    }
    
    /**
     * 更新订单的插件
     * 
     * @return array
     */
    protected function get_update_plugins()
    {
        $plugins = parent::get_update_plugins();
        
        //分销商信息插件
        $plugins[] = 'sellingagent';
        
        //分销金额插件
        $plugins[] = 'tbfx';
        
        return $plugins;
    }
}
