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

class taoguaninventory_finder_encoded_state{
    var $column_view = '操作';
    var $column_view_width = "100";
    var $addon_cols = "eid";
     function column_view($row){
         $id = $row[$this->col_prefix.'eid'];
         $finder_id = $_GET['_finder']['finder_id'];
$button= <<<EOF
<a href="index.php?app=taoguaninventory&ctl=admin_codestate&act=edit_state&p[0]=$id&finder_id=$finder_id" class="lnk" " target="dialog::{width:600,height:400,title:'编码编辑'}">编辑</a>&nbsp;
&nbsp;
EOF;
return $button;

     }

}

?>