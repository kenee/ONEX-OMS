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
 * o2o 阿里全渠道
 * 20160822
 * @author wangjianjun@shopex.cn
 * @version 1.0
 */
class o2o_extracolumn_inventory_opname extends o2o_extracolumn_abstract implements o2o_extracolumn_interface{

    protected $__pkey = 'inventory_id';

    protected $__extra_column = 'column_op_name';

    /**
     * 统一获取主键和op_name申请人之间的关系
     * @param $ids
     */
    public function associatedData($ids){
        //根据主键统一获取op_id 默认给 - 有效op_id给name
        $mdlO2oInventory = app::get('o2o')->model('inventory');
        $rs_info = $mdlO2oInventory->getList("inventory_id,op_id",array("inventory_id|in"=>$ids));
        $op_ids = array();
        foreach ($rs_info as $var){
            if($var["op_id"] && !in_array($var["op_id"], $op_ids)){
                $op_ids[] = $var["op_id"];
            }
        }
        $rl_inventory_id_op_name = array();
        if (empty($op_ids)){
            //全部给 -
            foreach ($rs_info as $var_info){
                $rl_inventory_id_op_name[$var_info["inventory_id"]] = "-";
            }
            return $rl_inventory_id_op_name;
        }
        
        $mdlDesktopUsers = app::get('desktop')->model('users');
        $rs_users = $mdlDesktopUsers->getList("user_id,name",array("user_id|in"=>$op_ids));
        if(empty($rs_users)){
            //全部给 - 
            foreach ($rs_info as $var_s){
                $rl_inventory_id_op_name[$var_s["inventory_id"]] = "-";
            }
            return $rl_inventory_id_op_name;
        }
        
        $rl_op_id_op_name = array();
        foreach ($rs_users as $var_user){
            $rl_op_id_op_name[$var_user["user_id"]] = $var_user["name"];
        }
        foreach ($rs_info as $var_f){
            $rl_inventory_id_op_name[$var_f["inventory_id"]] = "-";
            if($rl_op_id_op_name[$var_f["op_id"]]){
                $rl_inventory_id_op_name[$var_f["inventory_id"]] = $rl_op_id_op_name[$var_f["op_id"]];
            }
        }
        return $rl_inventory_id_op_name;
    }

}