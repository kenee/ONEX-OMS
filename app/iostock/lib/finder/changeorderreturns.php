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

class iostock_finder_changeorderreturns{
    var $column_member_name = '会员姓名';
    function column_member_name($row){
        $salesObj = app::get('ome')->model('sales');
        $member_id = $salesObj->dump(array('iostock_bn'=>$row['iostock_bn']),'member_id');
        $memberObj = app::get('ome')->model('members');
        $member_uname = $memberObj->dump(array('member_id'=>$member_id['member_id']),'uname');
        return $member_uname['account']['uname'];
    }

    var $column_name = '商品名称';
    function column_name($row){
        $basicMaterialObj = app::get('material')->model('basic_material');
        $name = $basicMaterialObj->dump(array('material_bn'=>$row['bn']),'material_name');
        return $name['material_name'];
    }

    var $column_amount = '退货金额';
    function column_amount($row){
        $ectoolObj = app::get('eccommon')->model('currency');
        $amount = $ectoolObj->formatNumber($row['iostock_price']*$row['nums']);
        return $amount;
    }
    var $addon_cols = 'iostock_bn';
    var $column_iostockbn = '销售出库单号';
    var $column_iostockbn_width = 150;
    function column_iostockbn($row){
        return $row[$this->col_prefix.'iostock_bn'];
    }
}