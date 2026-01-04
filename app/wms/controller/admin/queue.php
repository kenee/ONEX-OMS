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

class wms_ctl_admin_queue extends desktop_controller
{
    var $name = "导入中盘点";
    var $workground = "wms_center";
    /**
     * index
     * @return mixed 返回值
     */
    public function index(){
        $base_filter = array(
           'queue_title'=>'盘点导入',

         );
            $params = array(
            'title'=>app::get('desktop')->_('导入中盘点'),
            'actions'=>array(
                array('label'=>app::get('desktop')->_('全部启动'),'submit'=>'index.php?app=desktop&ctl=queue&act=run'),
                array('label'=>app::get('desktop')->_('全部暂停'),'submit'=>'index.php?app=desktop&ctl=queue&act=pause'),
                ),
            'base_filter' => $base_filter
            );

            $this->finder('base_mdl_queue',$params);
        }
}
?>