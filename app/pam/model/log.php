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


class pam_mdl_log extends dbeav_model
{
	public $appendCols = 'event_id,event_time,event_data,event_type';
	
	function searchOptions(){
        $childOptions = array(
            'op_name'=>app::get('ome')->_('用户名'),
        );
		return $childOptions;
    }

	function _filter($filter,$tableAlias=null,$baseWhere=null)
    {
        $tPre      = ($tableAlias ? $tableAlias : '`' . $this->table_name(true) . '`') . '.';
        $tmpBaseWhere = kernel::single('ome_filter_encrypt')->encrypt($filter, $this->__encrypt_cols, $tPre, 'orders');
        $baseWhere = $baseWhere ? array_merge((array)$baseWhere, (array)$tmpBaseWhere) : (array)$tmpBaseWhere;
       
		$where = " 1 ";
        if(isset($filter['op_name'])){
            $where  .= ' and event_data like "%'.$filter['op_name'].'%" ';
            unset($filter['op_name']);
        }
        
        return $where ." AND ".parent::_filter($filter,$tableAlias,$baseWhere);
    }

}
