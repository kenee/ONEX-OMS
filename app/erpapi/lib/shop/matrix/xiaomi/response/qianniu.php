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
 * 订单接口处理
 *
 * @category
 * @package
 * @author sunjing
 * @version $Id: Z
 */
class erpapi_shop_matrix_xiaomi_response_qianniu extends erpapi_shop_response_qianniu
{
    /**
     * ERP订单
     * 
     * @var string
     * */

    public $_order_detail= array();

    /**
     * 订单接收格式
     * 
     * @var string
     * */
    public $_qnordersdf = array();




        /**
     * 添加ress_modify
     * @param mixed $sdf sdf
     * @return mixed 返回值
     */
    public function address_modify($sdf)
    {

        $sdf['bizOrderId'] = $sdf['tid'];
        return parent::address_modify($sdf);
    }


    protected function _formatSdf(){
        if (is_string($this->_qnordersdf['modifiedAddress'])) {
            $this->_qnordersdf['modifiedAddress'] = json_decode($this->_qnordersdf['modifiedAddress'],true);
        }

        $modifiedAddress = $this->_qnordersdf['modifiedAddress'];

        if ($modifiedAddress['consignee'])           $this->_qnordersdf['consignee']['name']     = $modifiedAddress['consignee'];
        if ($modifiedAddress['province'])       $this->_qnordersdf['consignee']['province'] = $modifiedAddress['province']['name'];
        if ($modifiedAddress['city'])           $this->_qnordersdf['consignee']['city']     = $modifiedAddress['city']['name'];
        if ($modifiedAddress['area'])           $this->_qnordersdf['consignee']['area']     = $modifiedAddress['area']['name'];
        if ($modifiedAddress['address'])  $this->_qnordersdf['consignee']['addr']     = false !== strpos($modifiedAddress['address'], $modifiedAddress['area']['name']) ?$modifiedAddress['address'] : $modifiedAddress['area']['name'].$modifiedAddress['address'];
        if ($modifiedAddress['tel'])          $this->_qnordersdf['consignee']['mobile']   = $modifiedAddress['tel'];

    }

}
