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
 * 基础物料字段成本价
 * @author xiayuanjun@shopex.cn
 * @version 1.0
 */
class material_extracolumn_basicmaterial_cost extends desktop_extracolumn_abstract implements desktop_extracolumn_interface{

    protected $__pkey = 'bm_id';

    protected $__extra_column = 'column_cost';

    /**
     *
     * 获取基础物料字段成本价
     * @param $ids
     * @return array $tmp_array关联数据数组
     */
    public function associatedData($ids){
        //根据发货单ids获取相应的备注信息
        $basicMaterialExtObj = app::get('material')->model('basic_material_ext');
        $cost_lists = $basicMaterialExtObj->getList('cost,'.$this->__pkey,array($this->__pkey => $ids));

        $tmp_array= array();
        foreach($cost_lists as $k=>$row){
            if (!kernel::single('desktop_user')->has_permission('cost_price')) {
                $tmp_array[$row[$this->__pkey]] = '-';
            }else{
                $tmp_array[$row[$this->__pkey]] = $row['cost'];
            }
        }
        return $tmp_array;
    }

}