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

class financebase_finder_bill_category_rules {



    var $column_edit = "操作";
    var $column_edit_width = "150";

    function column_edit($row) {
        $finder_id = $_GET['_finder']['finder_id'];

        $ret = '<a href="index.php?app=financebase&ctl=admin_shop_settlement_rules&act=setCategory&p[0]='.$row['rule_id'].'&_finder[finder_id]=' . $finder_id . '&finder_id=' . $finder_id . '" target="dialog::{width:550,height:400,resizeable:false,title:\'编辑收支分类\'}">编辑</a>';

        return $ret;
    }


    var $column_platform = '平台规则设置（蓝色：已设置、红色：未设置)';
	var $column_platform_width = "500";
	var $column_platform_order = 20;
	function column_platform($row) {

		$finder_id = $_GET['_finder']['finder_id'];
		$oFunc = kernel::single('financebase_func');

		$platform = $oFunc->getShopPlatform();

		$ret = "";

		// TODO 优化
		$tmp = app::get('financebase')->model('bill_category_rules')->getRow('rule_content',array('rule_id'=>$row['rule_id']));
		$row['rule_content'] = $tmp['rule_content'];

		$rule_content = $row['rule_content'] ? json_decode($row['rule_content'],1) : array();
		foreach ($platform as $key => $value) {
			$color = (isset($rule_content[$key]) && $rule_content[$key]) ? 'blue' : 'red';
			$ret .= '<a style="color:'.$color.';" href="index.php?app=financebase&ctl=admin_shop_settlement_rules&act=setRule&p[0]='.$row['rule_id'].'&p[1]='.$key.'&_finder[finder_id]=' . $finder_id . '&finder_id=' . $finder_id . '" target="_blank">'.$value.'</a>&nbsp;&nbsp;&nbsp;&nbsp;';

		}

		return $ret;
	}



}

