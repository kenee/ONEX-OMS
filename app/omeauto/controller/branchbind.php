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

class omeauto_ctl_branchbind extends desktop_controller {
    var $workground = "goods_manager";

    function index() {
        $params = array(
            'title' => '仓库绑定设置',
            'base_filter' => array('disabled' => 'false','is_deliv_branch' => 'true','b_type'=>1),
            'use_buildin_recycle' => false,
            'finder_cols' => 'column_edit,name,branch_bn,is_deliv_branch,weight,memo',
        );
        $this->finder('omeauto_mdl_branch', $params);
    }

    /**
     * 设置“线上发货仓库”绑定“线上备货仓库”
     * 
     * @param integer $branch_id 仓库ID
     * @return void
     */
    function setBind($branch_id) {
        $branchObj = app::get('ome')->model('branch');
        $branchList = $branchObj->getList('*',array('disabled' => 'false','is_deliv_branch' => 'false'));
        $branch = $branchObj->dump($branch_id);
        $branch['bind_conf'] = unserialize($branch['bind_conf']);

        $this->pagedata['branch'] = $branch;
        $this->pagedata['branchList'] = $branchList;
        $this->page('branchbind/setBind.html');
    }

    /**
     * 保存仓库绑定信息
     * 
     * @return void 
     */
    function save() {
        //$this->begin("index.php?app=omeauto&ctl=autoconfirm&act=index");
        $data = $_POST;
        $data['bind_conf'] = $data['bind_conf'] ? serialize($data['bind_conf']) : '';
        //修改
        if ($data['branch_id']) {
            $branchObj = app::get('ome')->model('branch');
            $branchObj->update(array('bind_conf'=>$data['bind_conf']),array('branch_id'=>$data['branch_id']));
        }
        echo "SUCC";
    }
}