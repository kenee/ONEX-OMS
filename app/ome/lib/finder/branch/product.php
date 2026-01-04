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

class ome_finder_branch_product
{
    var $column_barcode = "条形码";
    var $column_barcode_width = "100";
    function column_barcode($row){
        return $row['barcode'];
    }
    var $column_bn = "货号";
    var $column_bn_width = "300";
    var $column_bn_order_field = "p.bn";
    function column_bn($row){
        return $row['bn'];
    }

    var $column_store_position = "货位";
    var $column_store_position_width = "150";
    function column_store_position($row)
    {
        $libBranchProductPos    = kernel::single('ome_branch_product_pos');
        
      $pos_info = $libBranchProductPos->get_pos($row['product_id'],$row['branch_id']);
      if(empty( $pos_info)){
          return '-';
      }
      $arr_store_position  = array();
      foreach( $pos_info as $v ){
          $arr_store_position[] = $v['store_position'];
      }
      if(empty($arr_store_position)){
          return '-';
      }
      $str_store_position = implode("|", $arr_store_position);
      return $str_store_position;
    }

    var $column_product_name = "货品名称";
    var $column_product_name_width = "100";
    function column_product_name($row){
        if ($row['sku_property']) $str = "(".$row['sku_property'].")";
        return $row['name'].$str;
    }

   var $column_spec_info = '规格';
   var $column_spec_info_width='80';
   function column_spec_info($row)
    {
        return $row['spec_info'];
    }

   var $column_unit = '单位';
   var $column_unit_width='80';
   function column_unit($row)
    {
        return $row['unit'];
    }

    var $column_branch_name = "仓库";
    var $column_branch_name_width = "150";
    function column_branch_name($row){
      $brObj = app::get('ome')->model('branch');
      $aRow = $brObj->dump($row['branch_id'], 'name');
        return $aRow['name'];
    }
    var $column_picurl = "图片预览";
    var $column_picurl_width = "150";
    function column_picurl($row){
        $picurl =  app::get('ome')->model('goods')->dump($row['goods_id'],'picurl');
        $img_src = $picurl['picurl'];
        if(!$img_src){
            return '';
        } 
        return "<a href='$img_src' class='img-tip pointer' target='_blank' onmouseover='bindFinderColTip(event);'><span>&nbsp;pic</span></a>";
    }

}

