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

class ome_exportextracolumn_arrive_store extends ome_exportextracolumn_abstract implements ome_exportextracolumn_interface{

    protected $__pkey = 'bm_id';

    protected $__extra_column = 'column_arrive_store';

    public function associatedData($ids){
        $lib_mbmsf = kernel::single('material_basic_material_stock_freeze');
        $tmp_array = array();
        foreach ($ids as $var_bm_id){
            $tmp_array[$var_bm_id] = $lib_mbmsf->getMaterialArriveStore($var_bm_id);
        }
        return $tmp_array;
    }

}