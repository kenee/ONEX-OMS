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
 * 订单处理
 *
 * @category 
 * @package 
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_shop_matrix_paipai_response_order extends erpapi_shop_response_order
{
    protected function get_update_components()
    {
        $components = array('markmemo','marktype','custommemo');

        return $components;
    }

    protected function _canAccept()
    {
        if ($this->_ordersdf['t_type'] == 'fenxiao' || $this->_ordersdf['order_source'] == 'taofenxiao') {
            $this->__apilog['result']['msg'] = '分销订单暂时不接收';
            return false;
        }


        //拍拍未成团订单不接收
        if ($this->_ordersdf['consignee']['area_state'] == '' 
            && $this->_ordersdf['consignee']['area_city'] == '' 
            && $this->_ordersdf['consignee']['area_district'] == '' 
            && (strpos($this->_ordersdf['consignee']['addr'],'未成团') !== false)) {
            $this->__apilog['result']['msg'] = '拍拍未成团订单不接收';

            return false;
        }

        return parent::_canAccept();
    }

    protected function _operationSel()
    {
        parent::_operationSel();
        $lastmodify = kernel::single('ome_func')->date2time($this->_ordersdf['lastmodify']);
        
        if (empty($this->_operationSel) && $lastmodify == $this->_tgOrder['outer_lastmodify']) {
            $this->_operationSel = 'update';
        }
    }

    protected function _analysis()
    {
        parent::_analysis();

        $mark_type = array(
            'red'    => 'b1',
            'yellow' => 'b3',
            'green'  => 'b7',
            'blue'   => 'b4',
            'pink'   => 'b6',
        );
        $buyer_flag = strtolower($this->_ordersdf['buyer_flag']);
        
        if ($mark_type[$buyer_flag]) {
            $this->_ordersdf['mark_type'] = $mark_type[$buyer_flag];
        }
    }
}
