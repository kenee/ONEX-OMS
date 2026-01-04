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


class finance_mdl_verification extends dbeav_model{
    function modifier_type($type){
        return kernel::single('finance_verification')->get_name_by_type($type);
    }

    function _filter($filter,$tableAlias=null,$baseWhere=null){
        if(isset($filter['search_bill_bn'])){
            $veritemObj = &app::get('finance')->model('verification_items');
            $rs = $veritemObj->getList('log_id',array('bill_bn'=>$filter['search_bill_bn']));
            foreach($rs as $v){
                $ids[] = $v['log_id'];
            }
            $log_id = implode(',', $ids);
            $where .= ' and log_id in ('.$log_id.")";
            unset($filter['search_bill_bn']);
        }
        $return = parent::_filter($filter,$tableAlias,$baseWhere).$where;
        return $return;
    }

    /**
     * 搜索Options
     * @return mixed 返回值
     */
    public function searchOptions(){
        return array(
            'log_bn'=>$this->app->_('核销流水号'),
            'search_bill_bn'=>$this->app->_('单据编号'),
        );
    }
}