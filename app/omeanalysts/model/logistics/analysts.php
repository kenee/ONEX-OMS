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

class omeanalysts_mdl_logistics_analysts extends dbeav_model {

	function analysts_data($data = null){
        $db = kernel::database();
        
        $data['to'] = $data['to'] + 86400;
        $sqlstr = '';
        if ($data['branch_id']){
        	$sqlstr.= ' AND branch_id='.$data['branch_id'];
        }
        $sql = "select sum(delivery_num) as delivery_num,sum(embrace_num) as embrace_num,sum(sign_num) as sign_num,sum(problem_num) as problem_num,sum(timeout_num) as timeout_num,logi_id from sdb_omeanalysts_logistics_analysts where trace_date >= ".$data['from']." AND trace_date <= ".$data['to']."".$sqlstr." GROUP BY logi_id";

        $rows = $db->select($sql);
        return $rows;
    }
}




?>