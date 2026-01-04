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

class finance_ctl_verification extends desktop_controller{
    var $name = "核销日志";

    /**
     * index
     * @return mixed 返回值
     */
    public function index(){
        $this->finder('finance_mdl_verification',array(
            'title'=>app::get('finance')->_('核销日志'),
            'use_buildin_recycle'=>false,
            'use_view_tab'=>true,
            'use_buildin_selectrow'=>true,
            'use_buildin_filter'=>true,
            'finder_cols'=>'column_edit,log_bn,type,op_name,op_time,money,content',
        ));
    }

    /*
    **取消核销
    */

    public function do_cancel(){
        $url = 'index.php?app=finance&ctl=verification&act=index';
        $log_id = $_POST['log_id'];
        $rs = kernel::single('finance_verification')->do_cancel($log_id);
        if($rs == 'false'){
            $this->splash('error',$url,'撤销失败');
        }
        $this->splash('success',$url,'撤销成功');
    }
}