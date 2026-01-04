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

class ome_mdl_payment_cfg extends dbeav_model{
    /**
     * _filter
     * @param mixed $filter filter
     * @param mixed $tableAlias tableAlias
     * @param mixed $baseWhere baseWhere
     * @return mixed 返回值
     */
    public function _filter($filter,$tableAlias=null,$baseWhere=null){
        $where = array(1);
        if(isset($filter['shop_id'])){
            $paymentShopObj = $this->app->model("payment_shop");
            $payments = $paymentShopObj->getList('pay_bn', array('shop_id'=>$filter['shop_id']));
            $pay_bn = array(1);
            foreach($payments as $payment){
                $pay_bn[] = $payment['pay_bn'];
            }

            $where[] = ' pay_bn in(\''.implode('\',\'', $pay_bn).'\')';
            unset($filter['shop_id']);
        }
        return parent::_filter($filter,$tableAlias,$baseWhere)." AND ".implode(' AND ', $where);
    }

    /**
     * modifier_pay_type
     * @param mixed $row row
     * @return mixed 返回值
     */
    public function modifier_pay_type($row){
        $tmp = ome_payment_type::pay_type_name($row);
        return $tmp;
    }
}