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

class purchase_finder_inventory{
    var $detail_basic = "盘点记录";
    
    function __construct(){
        
        if ($_GET['act']=='confirm'){
            unset($this->column_view);
        }
        
        if ($_GET['act']=='import'){
            unset($this->column_confirm);
        }
        
    }
    
    function detail_basic($inventory_id){

        $render = app::get('purchase')->render();
        $oInventory = app::get('purchase')->model("inventory");
        $inventory_detail = $oInventory->dump($inventory_id, '*');
        
        $render->pagedata['detail'] = $inventory_detail;
        return $render->fetch('admin/inventory/base_detail.html');
    }
    
    var $addon_cols = "inventory_id,import_status";
    var $column_view = '盘点明细';
    var $column_view_width = "60";
    function column_view($row){
        $id = $row[$this->col_prefix.'inventory_id'];
        $import_status = $row[$this->col_prefix.'import_status'];
        
        $button = <<<EOF
         <a href="index.php?app=purchase&ctl=admin_inventory&act=confirm_detail&p[0]=$id&view=true" class="lnk">查看</a>
        
EOF;
        //盘点导入查看
        return $button;
    }
    
    var $column_confirm = '盘点损益';
    var $column_confirm_width = "60";
    function column_confirm($row){
        $id = $row[$this->col_prefix.'inventory_id'];
        $import_status = $row[$this->col_prefix.'import_status'];
        
        if ($import_status=='2'){
        $button = <<<EOF
         <a href="index.php?app=purchase&ctl=admin_inventory&act=confirm_detail&p[0]=$id" class="lnk">确认</a>
        
EOF;
        }else $button = '-';
        return $button;
    }
    
}
?>