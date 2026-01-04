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

class pos_mdl_syncproduct extends dbeav_model {

    /**
     * _filter
     * @param mixed $filter filter
     * @param mixed $tableAlias tableAlias
     * @param mixed $baseWhere baseWhere
     * @return mixed 返回值
     */
    public function _filter($filter,$tableAlias=null,$baseWhere=null)
    {
        // 多货号查询
        if($filter['material_bn'] && is_string($filter['material_bn']) && strpos($filter['material_bn'], "\n") !== false){
            $filter['material_bn'] = array_unique(array_map('trim', array_filter(explode("\n", $filter['material_bn']))));
        }

        return parent::_filter($filter, $tableAlias, $baseWhere);
    }

    /**
     * replaceinsert
     * @param mixed $data 数据
     * @return mixed 返回值
     */
    public function replaceinsert($data)
    {
        $columns = $this->schema['columns'];

        $strFields=$strValue=array();
        foreach ($data as $d) {
            $insertValues = array();
            foreach ($d as $c => $v) {
                if (!isset($columns[$c])) continue;

                $insertValues[$c] = $this->db->quote($v);

            }

            if (!$insertValues) continue;

            $strValue[] = "(".implode(',',$insertValues).")";
        }

        $strFields = array_keys($insertValues);

        if (!$strFields || !$strValue) return ;

        $strFields = implode('`,`', $strFields);$strValue = implode(',', $strValue);

        $sql = 'REPLACE INTO `'.$this->table_name(true).'` ( `'.$strFields.'` ) VALUES '.$strValue;

        $this->db->exec($sql);
    }
   
}