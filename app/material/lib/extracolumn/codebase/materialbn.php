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
 * 码库基础物料编码字段
 * @author xiayuanjun@shopex.cn
 * @version 1.0
 */
class material_extracolumn_codebase_materialbn extends desktop_extracolumn_abstract implements desktop_extracolumn_interface{

    protected $__pkey = 'bm_id';

    protected $__extra_column = 'column_material_bn';

    /**
     *
     * 获取基础物料编码字段
     * @param $ids
     * @return array $tmp_array关联数据数组
     */
    public function associatedData($ids){
        //根据物料ids获取相应的物料编码信息
        $basicMaterialObj = app::get('material')->model('basic_material');
        $bn_lists = $basicMaterialObj->getList('material_bn,'.$this->__pkey,array($this->__pkey => $ids));

        $tmp_array= array();
        foreach($bn_lists as $k=>$row){
             $tmp_array[$row[$this->__pkey]] = $row['material_bn'];
        }
        return $tmp_array;
    }

}