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

class iostock_finder_damaged{
var $column_in = '目标仓库编号';
    function column_in($row){      
        $sql = "select branch_id from sdb_ome_iostock where type_id=50";
        $branch_id = kernel::database()->select($sql);
        $sql2 = "select branch_bn from sdb_ome_branch where branch_id=".$branch_id[0]['branch_id']."";
        $branch_bn = kernel::database()->select($sql2);         
        return $branch_bn[0]['branch_bn'];
    }
     var $column_inname = '目标仓库名称';
    function column_inname($row){
        $sql = "select branch_id from sdb_ome_iostock where type_id=50";
        $branch_id = kernel::database()->select($sql);
        $sql2 = "select name from sdb_ome_branch where branch_id=".$branch_id[0]['branch_id']."";
        $branch_bn = kernel::database()->select($sql2);
        return $branch_bn[0]['name'];
    }
    var $column_out = '来源仓库编号';
    function column_out($row){
        $sql = "select branch_id from sdb_ome_iostock where type_id=5";
        $branch_id = kernel::database()->select($sql);
        $sql2 = "select branch_bn from sdb_ome_branch where branch_id=".$branch_id[0]['branch_id']."";
        $branch_bn = kernel::database()->select($sql2);   
        return $branch_bn[0]['branch_bn'];
    }
    var $column_outname = '来源仓库名称';
    function column_outname($row){
        $sql = "select branch_id from sdb_ome_iostock where type_id=5";
        $branch_id = kernel::database()->select($sql);
        $sql2 = "select name from sdb_ome_branch where branch_id=".$branch_id[0]['branch_id']."";
        $branch_bn = kernel::database()->select($sql2);
        return $branch_bn[0]['name'];
    }
    var $column_detail = 'detail';
    function detail_edit($id){
        $render = app::get('iostock')->render();
        $oItem = kernel::single("ome_mdl_iostock");
        $items = $oItem->getList('*',array('iostock_id'=>$id));
        $product = kernel::single('ome_mdl_products');
        $pname = $product->getList('name',array('bn'=>$items[0]['bn']));
        $render->pagedata['pname'] = $pname[0];
        $render->pagedata['items'] = $items;
        $render->display('damaged.html');

    }

}