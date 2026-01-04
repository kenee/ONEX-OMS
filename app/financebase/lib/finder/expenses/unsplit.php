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
/**
 * ============================
 * @Author:   yaokangming
 * @Version:  1.0
 * @DateTime: 2020/12/4 11:49:52
 * @describe: 费用均摊
 * ============================
 */
class financebase_finder_expenses_unsplit {
    public $addon_cols = 'bill_category';

    public $column_edit = "操作";
    public $column_edit_width = "80";
    public $column_edit_order = 1;
    /**
     * column_edit
     * @param mixed $row row
     * @return mixed 返回值
     */

    public function column_edit($row) {
        $finder_id = $_GET['_finder']['finder_id'];
        $ret = '<a href="index.php?app=financebase&ctl=admin_expenses_splititem&act=split&p[0]='.$row['id'].'&finder_id=' . $finder_id . '&view='.intval($_GET['view']).'" target="dialog::{width:350,height:200,title:\'再次拆分\'}">再次拆分</a>';

        return $ret;
    }
}