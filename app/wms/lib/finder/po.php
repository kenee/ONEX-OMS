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

//class wms_finder_po{
//    function __construct($app)
//    {
//        $this->app = $app;
//        
//        if($_GET['app']!='wms'){
//            
//            #unset($this->column_edit);
//        }
//    }
//    var $addon_cols = "po_id,eo_status,statement,po_status,po_type,check_status";
//    var $column_edit = "操作";
//    var $column_edit_width = "150";
//    function column_edit($row){
//        echo 'f';
//        $find_id = $_GET['_finder']['finder_id'];
//        $id = $row[$this->col_prefix.'po_id'];
//        $stockset= app::get('ome')->getConf('purchase.stock.stockset');
//
//        $user = kernel::single('desktop_user');
//
//
//      $width = 80;
//         $button2 = <<<EOF
//        <a class="lnk" href="index.php?app=wms&ctl=admin_eo&act=eo_confirm&p[0]=$id&find_id=$find_id" target="_blank">传统入库</a>
//EOF;
//         $button22 = <<<EOF
//        <a class="lnk" href="index.php?app=wms&ctl=admin_eo&act=Barcode_stock&p[0]=$id&find_id=$find_id" target="_blank">条码入库</a>
//EOF;
//$button3 = <<<EOF
//        <span class="lnk" onclick="new Dialog('index.php?app=wms&ctl=admin_purchase&act=cancel&p[0]=$id&p[1]=cancel',{title:'入库终止',width:500,height:250})">终止</span> |
//EOF;
//        $button3_disabled = <<<EOF
//        <span class="c-disabled">终止</span> |
//EOF;
//
//        $button21 = <<<EOF
//        <a class="lnk" href="index.php?app=wms&ctl=admin_purchase&act=printItem&p[0]=$id&p[1]=eo" target="_bank">打印</a> |
//EOF;
//        $string = '';
//        if( $row[$this->col_prefix.'eo_status'] <> '3' && $row[$this->col_prefix.'check_status']==2 ){
//            if($stockset=='true'){
//                $string .= $button22;
//            }else{
//                $string .= $button2;
//            }
//              $string .= " | ".$button21;
//        }
//
//        $string = '<span class="c-gray">'.$string.'</span>';
//        return $string;
//    }
//
//}