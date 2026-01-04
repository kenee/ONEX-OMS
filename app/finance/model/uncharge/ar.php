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

class finance_mdl_uncharge_ar extends dbeav_model{

    var $defaultOrder = array('ar_id DESC');
    public $filter_use_like = true;

    public function table_name($real=false){
        $tableName = 'ar';
        return $real ? kernel::database()->prefix.'finance_'.$tableName : $tableName;

    }

    // public function searchOptions(){
    //     return array();
    // }


    function modifier_type($row){
        return kernel::single('finance_ar')->get_name_by_type($row);
    }

    //重载记账状态，展示
    function modifier_charge_status($row){
        return kernel::single('finance_ar')->get_name_by_charge_status($row);
    }

    //重载核销状态，展示
    function modifier_status($row){
        return kernel::single('finance_ar')->get_name_by_status($row);
    }

    //重载核销状态，展示
    function modifier_monthly_status($row){
        return kernel::single('finance_ar')->get_name_by_monthly_status($row);
    }

    //重载单据类型
    function modifier_ar_type($row){
        return kernel::single('finance_ar')->get_name_by_ar_type($row);
    }




}
