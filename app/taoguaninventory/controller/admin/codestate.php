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

class taoguaninventory_ctl_admin_codestate extends desktop_controller{
    var $name = "编码状态信息";
    var $workground = "setting_tools";
    function index(){

        $action=array(
                        array('label' =>'新建', 'href' => 'index.php?app=taoguaninventory&ctl=admin_codestate&act=add','target' => 'dialog::{width:700,height:400,title:\'编码新建\'}'));
        $params = array(
                        'title'=>'编码状态信息',
                        'use_buildin_new_dialog' => false,
                        'use_buildin_set_tag'=>false,
                        'use_buildin_recycle'=>false,
                        'use_buildin_export'=>false,

                        'use_buildin_filter'=>true,
						                  'orderBy'=>'eid DESC',
                      //  'actions'=>$action,
                    );
        $this->finder('taoguaninventory_mdl_encoded_state',$params);
    }

    /**
     * 新建
     */
    function edit_state($eid){

        $oState = app::get('taoguaninventory')->model('encoded_state');
        $state = $oState->dump($eid,'*');
        $this->pagedata['state']=$state;
        unset($state);
        $this->page('admin/encode/add.html');
    }

    /**
     * 保存
     */
    function save(){
        $this->begin();
        $data = array();
        $oState = app::get('taoguaninventory')->model('encoded_state');

        $data = array(
            'eid' => $_POST['eid'],
            'head'  =>$_POST['head'],
            'bhlen'=>$_POST['bhlen'],

        );
        $result = $oState->save($data);
        if( $result ){
            $this->end(true, '成功', 'index.php?app=taoguaninventory&ctl=admin_codestate&act=index');
        }else{
            $this->end(false, '失败.');
        }

    }

/**
获取状态信息
*/
    function getencode(){
        $name = $_GET['name'];
        $oState = app::get('taoguaninventory')->model('encoded_state');
        if($name){
            $state = $oState->dump(array('name'=>$name),'name');
            $date = array();
            if($state){
                $date['message'] = '存在';
            }else{
                $date['message'] = '不存在';
            }
            echo json_encode($date);
        }
    }
}
?>