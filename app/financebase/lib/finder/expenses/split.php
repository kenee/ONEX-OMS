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
 * ============================
 * @Author:   yaokangming
 * @Version:  1.0
 * @DateTime: 2020/12/3 18:00:11
 * @describe: 费用均摊明细
 * ============================
 */
class financebase_finder_expenses_split {
    public $addon_cols = 'bm_id';

    public $column_skucode = "基础物料编码";
    public $column_skucode_width = "80";
    /**
     * column_skucode
     * @param mixed $row row
     * @return mixed 返回值
     */

    public function column_skucode($row) {
        $bmId = $row[$this->col_prefix . 'bm_id'];
        $bm = app::get('material')->model('basic_material')->db_dump(array('bm_id'=>$bmId), 'material_bn');
        return (string)$bm['material_bn'];
    }
}