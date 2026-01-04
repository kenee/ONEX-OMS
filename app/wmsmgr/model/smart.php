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

class wmsmgr_mdl_smart extends channel_mdl_channel
{
    /**
     * table_name
     * @param mixed $real real
     * @return mixed 返回值
     */
    public function table_name($real = false)
    {
        if($real){
           $table_name = 'sdb_channel_channel';
        }else{
           $table_name = 'channel';
        }
        
        return $table_name;
    }

    /**
     * 获取_schema
     * @return mixed 返回结果
     */
    public function get_schema()
    {
        return app::get('channel')->model('channel')->get_schema();
    }
    
    function _filter($filter,$tableAlias=null,$baseWhere=null)
    {
        $where = " 1 ";
        
        if ($filter['not_o2o_node_type']) {
            $where.=" AND ".$filter['not_o2o_node_type'];
        }
        
        return $where ." AND ".parent::_filter($filter,$tableAlias,$baseWhere);
    }
}