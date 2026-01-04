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
/**
 * 京准通账单明细model类
 *
 * @author wangbiao<wangbiao@shopex.cn>
 * @version $Id: Z
 */
class financebase_mdl_bill_import_jzt extends dbeav_model
{
    public $filter_use_like = true;
    
    /**
     * _filter
     * @param mixed $filter filter
     * @param mixed $tableAlias tableAlias
     * @param mixed $baseWhere baseWhere
     * @return mixed 返回值
     */

    public function _filter($filter, $tableAlias = NULL, $baseWhere = NULL)
    {
        return parent::_filter($filter, $tableAlias, $baseWhere).$where;
    }
    
    /**
     * 不建议使用这个方法
     * 请直接使用$this->dump()方法
     * 
     */
    public function getRow($cols='*', $filter=array())
    {
        $sql = "SELECT $cols FROM ".$this->table_name(true)." WHERE ".$this->filter($filter);
        
        return $this->db->selectrow($sql);
    }
}
