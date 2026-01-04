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

class wms_batch_log{

    function getStatus($status){
        $status_array = array(
          '0' => '等待中',
          '1' => '已处理',
          '2' => '处理中',

        );
        return $status_array[$status];
    }

    function get_List($log_type,$log_id,$status){
        $db = kernel::database();
        $log_id = implode(',',$log_id);
        $sqlstr = [];
        if($log_type){
            $sqlstr[]=' log_type=\''.$log_type.'\'';
        }
        if($log_id){
            $sqlstr[]=' log_id in ('.$log_id.')';
        }
        if($sqlstr){
            $sqlstr= 'WHERE '.implode(' AND ',$sqlstr);
        }

        $sql = 'SELECT * FROM sdb_wms_batch_log '.$sqlstr.' ORDER BY log_id DESC';

        return $db->select($sql);
    }
}
?>