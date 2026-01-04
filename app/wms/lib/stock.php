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

class wms_stock{

    /**
     * 库存查询相关方法，2011.11.01更新
     */
    function search_stockinfo($keywords,$branch_type='all')
    {
        $db = kernel::database();
        
        $product_ids = array();
        $product_info = array();
        
        # [模板搜索]基础物料
        $basicMaterialSelect    = kernel::single('material_basic_select');
        $product_info    = $basicMaterialSelect->search_stockinfo($keywords, $branch_type);
        
        return $product_info;
    }
}
?>