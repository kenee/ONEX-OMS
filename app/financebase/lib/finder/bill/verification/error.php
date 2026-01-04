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

class financebase_finder_bill_verification_error {



    var $column_edit = "操作";
    var $column_edit_width = "150";

    function column_edit($row) {
        $finder_id = $_GET['_finder']['finder_id'];

        $ret = '<a href="index.php?app=financebase&ctl=admin_shop_settlement_verification&act=setVerificationError&p[0]='.$row['id'].'&_finder[finder_id]=' . $finder_id . '&finder_id=' . $finder_id . '" target="dialog::{width:550,height:400,resizeable:false,title:\'核销规则编辑\'}">编辑</a>';

        return $ret;
    }



    var $detail_oplog = "操作日志";
    function detail_oplog($id){
        $render = app::get('financebase')->render();
        $mdlOpLog = app::get('financebase')->model("bill_verification_error");


        $info= $mdlOpLog->getRow('memo',array('id'=>$id));
        
        $list = @unserialize($info['memo']);
        $list = $list ?: [];
        
 		$render->pagedata['list'] = array_reverse($list);

        return $render->fetch("admin/verification/op_logs.html");
    }





}

