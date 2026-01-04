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


/* TODO: Add code here */
class desktop_finder_roles{
    var $column_control = '角色操作';
    function __construct($app){
        $this->app= $app;
        $this->obj_roles = kernel::single('desktop_roles');
    }
        
    function column_control($row){
        $is_user_roles_edit = kernel::single('desktop_user')->has_permission('user_roles_edit');
        if(!$is_user_roles_edit){
           return false;
        }
        $render = $this->app->render();
        $render->pagedata['role_id'] = $row['role_id'];
        return $render->fetch('users/href.html');
      }
    
    function detail_indo($param_id){
        $render = $this->app->render();
        $opctl = $this->app->model('roles');
        $menus = $this->app->model('menus');
        $sdf_roles = $opctl->dump($param_id);
        $render->pagedata['roles'] = $sdf_roles;
        $workground = unserialize($sdf_roles['workground']);
        foreach((array)$workground as $v){
            #$sdf = $menus->dump($v);
            $menuname = $menus->getList('*',array('menu_type' =>'menu','permission' => $v));
            foreach($menuname as $val){
                $menu_workground[] = $val['workground'];
            }
        }
        $menu_workground = array_unique((array)$menu_workground);
        #print_r($menu_workground);exit;
        $workgrounds = app::get('desktop')->model('menus')->getList('*',array('menu_type'=>'workground','disabled'=>'false','display'=>'true'));
        foreach($workgrounds as $k => $v){
            $workgrounds[$k]['permissions'] = $this->obj_roles->get_permission_per($v['menu_id'],$workground);
            if(in_array($v['workground'],(array)$menu_workground)){
                $workgrounds[$k]['checked'] = 1;
                
            }
        }
        $widgets = app::get('desktop')->model('menus')->getList('*',array('menu_type'=>'widgets'));
            
            foreach($widgets as $key=>$widget){
                if(in_array($widget['addon'],$workground))
                    $__widgets[] = $widget;
            }
        $render->pagedata['workgrounds'] = $workgrounds;
        $render->pagedata['adminpanels'] = $this->obj_roles->get_adminpanel($param_id,$workground,$flg);
        $render->pagedata['widgets'] = $__widgets;
        $render->pagedata['others'] = $this->obj_roles->get_others($workground,$othersflg);
        $render->pagedata['othersflg'] = $othersflg;
        $render->pagedata['flg'] = $flg;
        echo $render->fetch('users/users_roles.html');
    }
}
?>
