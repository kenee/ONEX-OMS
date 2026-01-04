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

class iostock_finder_purchaseReturns{
   
    var $column_branchbn = '仓库编号';
    function column_branchbn($row){
       $branch_bn = "select branch_bn from sdb_ome_branch where branch_id=".$row['branch_id'];
       $bn = kernel::database()->select($branch_bn);
       return $bn[0]['branch_bn'];
    }
       var $column_productname = '商品名称';
    function column_productname($row){
        $sql = "select material_name AS name from sdb_material_basic_material where material_bn='".$row['bn']."'";
        $name = kernel::database()->select($sql);
        return $name[0]['name'];
    }
    var $addon_cols = 'supplier_name';
    var $column_suppliername = '供应商名称';
    function column_suppliername($row){
        return $row[$this->col_prefix . 'supplier_name'];
    }
}
