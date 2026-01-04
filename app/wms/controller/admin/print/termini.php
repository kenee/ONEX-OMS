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

class wms_ctl_admin_print_termini extends desktop_controller{
    var $name = "大头笔设置";
    var $workground = "setting_tools";

    function index(){
        $actions = array(
            array(
                'label' => '添加大头笔',
                'href' => 'index.php?app=wms&ctl=admin_print_termini&act=add&finder_id='.$_GET['finder_id'],
                'target' => "dialog::{width:600,height:430,title:'添加大头笔'}",
            ),
        );
        $params = array(
            'title'=>'大头笔设置',
            'actions'=>$actions,
            'use_buildin_new_dialog' => false,
            'use_buildin_set_tag'=>false,
            'use_buildin_recycle'=>true,
            'use_buildin_export'=>false,
            'use_buildin_import'=>false,
        );
        $this->finder('wms_mdl_print_tag', $params);
    }

    function add() {
        $this->_edit();
    }

    function edit($tag_id) {
        $this->_edit($tag_id);
    }

    private function _edit($tag_id=NULL) {
        $data = array();
        if(!empty($tag_id) && $tag_id>0){
            $printTagObj = app::get('wms')->model('print_tag');
            $data = $printTagObj->dump($tag_id);
            $data['config']= unserialize($data['config']);
        }
        $this->pagedata['data'] = $data;
        $this->page('admin/print/express_termini.html');
    }

    function save() {
        $data['name']= $_POST['name'];
        $data['intro']= $_POST['intro'];
        $data['config']= serialize($_POST['config']);
        $data['create_time']= time();
        $tag_id = intval($_POST['tag_id']) ;
        if (!empty($tag_id) && $tag_id>0) {
            $data['tag_id'] = $tag_id;
            unset($data['create_time']);
        }
        app::get('wms')->model('print_tag')->save($data);
        echo "SUCC";
    }
}
?>
