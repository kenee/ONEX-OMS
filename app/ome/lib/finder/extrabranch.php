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

class ome_finder_extrabranch{
    var $detail_basic = "查看";
    var $detail_basic_width = "50";
    function detail_basic($branch_id){
        $render = app::get('ome')->render();
        $oExtrabranch = app::get('ome')->model('extrabranch');

        $render->pagedata['branch'] = $oExtrabranch->dump($branch_id);

        return $render->fetch('admin/extrabranch/branch_detail.html');
    }

    var $addon_cols = "branch_id";
    var $column_edit = "操作";
    var $column_edit_width = "50";
    function column_edit($row){
        $finder_id = $_GET['_finder']['finder_id'];
        return '<a href="index.php?app=ome&ctl=admin_extrabranch&act=editbranch&p[0]='.$row[$this->col_prefix.'branch_id'].'&p[1]=true&_finder[finder_id]='.$finder_id.'&finder_id='.$finder_id.'" target="_blank">编辑</a>';
    }
}
?>