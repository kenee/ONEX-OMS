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

class ome_mdl_branch_props extends dbeav_model
{
    /**
     * 获取仓库的扩展字段值
     * @param string $branch_id 仓库ID
     * @return array 扩展字段值数组
     */
    public function getPropsByBranchId($branch_id)
    {
        if (empty($branch_id)) {
            return array();
        }
        
        $propsList = $this->getlist('*', ['branch_id' => $branch_id]);
        
        $arr_props = array();
        foreach($propsList as $v) {
            $arr_props[$v['props_col']] = $v['props_value'];
        }
        
        return $arr_props;
    }
    
    /**
     * 保存仓库扩展字段值
     * @param string $branch_id 仓库ID
     * @param array $props 扩展字段值数组
     * @return bool 保存结果
     */
    public function saveProps($branch_id, $props)
    {
        if (empty($branch_id) || empty($props)) {
            return false;
        }
        
        // 获取当前操作人信息
        $operator = kernel::single('desktop_user')->get_name();
        
        foreach($props as $col_key => $col_value) {
            if (!empty($col_value)) {
                $propsdata = array(
                    'branch_id'     => $branch_id,
                    'props_col'     => is_string($col_key) ? trim($col_key) : $col_key,
                    'props_value'   => is_string($col_value) ? trim($col_value) : $col_value,
                    'operator'      => $operator,
                );
                
                // 检查是否已存在
                $existing = $this->db_dump(array('branch_id' => $branch_id, 'props_col' => $col_key), 'id');
                if ($existing) {
                    $propsdata['id'] = $existing['id'];
                }
                
                $this->save($propsdata);
            }
        }
        
        return true;
    }
} 