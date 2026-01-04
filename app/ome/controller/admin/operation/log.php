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

class ome_ctl_admin_operation_log extends desktop_controller {
    var $workground = "setting_tools";

    function index() {
        $orderby = ' operate_time desc ';
        $this->title = '操作日志';
        $base_filter = ['log_id|bthan'=>1]; // 没有where条件，EXPLAIN发现count的时候，mysql会用op_id当索引
        $actions = array();
        $params = array(
            'title'=>$this->title,
            'actions'=> $actions,
            'use_buildin_new_dialog' => false,
            'use_buildin_set_tag'=>false,
            'use_buildin_recycle'=>false,
            'use_buildin_export'=>false,
            'use_buildin_import'=>false,
            'use_buildin_filter'=>true,
            'orderBy' => $orderby,
        );
        if ($base_filter) {
            $params['base_filter'] = $base_filter;
        }
        if(!isset($_GET['action'])) {
            $panel = new desktop_panel($this);
            $panel->setId('ome_operation_log_finder_top');
            $panel->setTmpl('admin/finder/finder_panel_filter.html');
            $panel->show('ome_mdl_operation_log', $params);
        }
        $this->finder('ome_mdl_operation_log', $params);
    }
    
    //后台展示开启拆单的配置日志
    /**
     * split_logs
     * @return mixed 返回值
     */
    public function split_logs()
    {
        header("cache-control:no-store,no-cache,must-revalidate");
    
        $data = array();
        $operationLog    = app::get('ome')->model('operation_log');
        $data    = $operationLog->getList('*', array('operation'=>'order_split@ome', 'obj_id'=>'0'), 0, 200, 'operate_time desc');
    
        $this->pagedata['data']    = $data;
    
        $this->singlepage("admin/delivery/show_split_config_logs.html");
    }

    function login_list() {

        $orderby = ' event_time desc ';
        $this->title = '登录日志';
        $base_filter = ['event_type'=>'shopadmin'];
        $actions = [];
        $params = array(
            'title'=>$this->title,
            'actions'=> $actions,
            'use_buildin_new_dialog' => false,
            'use_buildin_set_tag'=>false,
            'use_buildin_recycle'=>false,
            'use_buildin_export'=>false,
            'use_buildin_import'=>false,
            'use_buildin_filter'=>true,
            'orderBy' => $orderby,
        );
        if ($base_filter) {
            $params['base_filter'] = $base_filter;
        }
        $this->finder('pam_mdl_log', $params);
    }
}