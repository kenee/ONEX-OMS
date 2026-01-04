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


class ome_concurrent{
    
	 /**
     * 自动清除同步日志
     * 每天检测将超2天的日志数据清除
     */
    public function clean(){
        
        $now = strtotime(date("Y-m-d"));
        $db = kernel::database();

        $where = " WHERE `current_time`<'".($now-2*24*60*60)."' ";
        $del_sql = " DELETE FROM `sdb_ome_concurrent` $where ";
        $db->exec($del_sql);
        
        $del_sql = 'DELETE FROM `sdb_ome_concurrent` WHERE `current_time` IS NULL';
        $db->exec($del_sql);

        $del_sql = 'OPTIMIZE TABLE `sdb_ome_concurrent`';
        $db->exec($del_sql);
    }
    
}