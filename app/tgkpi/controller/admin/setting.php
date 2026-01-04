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

class tgkpi_ctl_admin_setting extends desktop_controller{
    var $name = "绩效配置";
    var $workground = "performance";

     /*
     * 订单异常类型设置
     */
    function reason(){
        $this->finder('tgkpi_mdl_reason',array(
            'title'=>'校验失败原因设置',
            'actions'=>array(
                            array(
                                'label'=>'添加',
                                'href'=>'index.php?app=tgkpi&ctl=admin_setting&act=addreason',
                                 'target' => 'dialog::{width:450,height:150,title:\'新建校验失败原因\'}'
                            ),
                        ),
            'use_buildin_new_dialog' => false,
            'use_buildin_set_tag'=>false,
            'use_buildin_recycle'=>false,
            'use_buildin_export'=>false,
            'use_buildin_import'=>false,
         ));
    }
    /*
    * 添加订单异常类型
    */
    function addreason(){
        $reasonObj = $this->app->model("reason");
        if($_POST){
            $this->begin($this->url.'&act=reason');
            $data['reason_memo'] = $_POST['memo'];
            if($_POST['reason_id']){
                $data['reason_id'] = $_POST['reason_id'];
            }
            $reasonObj->save($data);
            $this->end(true, '保存成功');
        }
        $this->pagedata['title'] = '添加校验失败原因';
        $this->page("admin/setting/reason.html");
    }
    /*
    * 编辑订单异常类型
    */
    function editreason($id){
        $reasonObj = $this->app->model("reason");
        $this->pagedata['reason']=$reasonObj->dump($id);
        $this->pagedata['title'] = '编辑校验失败原因';
        $this->page("admin/setting/reason.html");
    }
}
?>
