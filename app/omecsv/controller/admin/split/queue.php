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
/**
 * 队列控制层
 * Class ome_ctl_admin_split_queue
 */
class omecsv_ctl_admin_split_queue extends desktop_controller
{
    // 任务列表
    /**
     * index
     * @return mixed 返回值
     */

    public function index()
    {
        $base_filter = [];
        $actions = [
            [
                'label'  => '导入任务',
                'href'   => sprintf('%s&act=task_import', $this->url),
                'target' => 'dialog::{width:760,height:300,title:\'导入任务\'}',
            ],
        ];
        $params      = array(
            'title'               => '任务列表',
            'actions'             => $actions,
            'base_filter'         => $base_filter,
            'use_buildin_set_tag' => false,
            'use_buildin_recycle' => false,
            'use_buildin_filter'  => true,
            'use_bulidin_view'    => true,
            'use_buildin_export'  => false,
            'use_buildin_import'  => false,
            'orderBy'             => 'queue_id desc',
        );
        
        $this->finder('omecsv_mdl_queue', $params);
    }
    
    /**
     * task_import
     * @return mixed 返回值
     */
    public function task_import()
    {
        $this->pagedata['beginurl'] = $this->url . '&act=index';
        $this->display('admin/task/import/normal.html');
    }
}