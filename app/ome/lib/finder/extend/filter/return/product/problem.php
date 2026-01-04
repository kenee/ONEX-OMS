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

class ome_finder_extend_filter_return_product_problem{
    function get_extend_colums(){
        $obj_problem = app::get('ome')->model('return_product_problem');
        $all_problem = $obj_problem->getList('*',array());
        $arr_problem = array();
        foreach($all_problem as $v){
            $_key = $v['problem_id'];
            $arr_problem[$_key] = $v['problem_name'];
        } 
        $db['return_product_problem']=array (
            'columns' => array (
                'problem_id' =>
                    array(
                            'type' => $arr_problem,
                            'filtertype' => 'normal',
                            'required' => true,
                            'label' => '售后类型',
                            'editable' => false,
                            'in_list' => true,
                            'default_in_list' => true,
                            'default' => 0,
                            'filterdefault' => true,
                            'panel_id' => 'ome_branch_finder_top',
                    ),
            )
        );
        return $db;
    }


}