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
 * @Author: xueding@shopex.cn
 * @Vsersion: 2022/10/17
 * @Describe: 监控通知控制器
 */
class monitor_ctl_admin_alarm_notify extends desktop_controller
{
    
    function index()
    {
        $actions = array(
            array(
                'label'  => '批量重发',
                'submit' => 'index.php?app=monitor&ctl=admin_alarm_notify&act=batchSend',
                'target' => 'dialog::{width:690,height:200,title:\'批量重发\'}'
            )
        );
        $params  = array(
            'title'               => '通知日志',
            'use_buildin_set_tag' => false,
            'use_buildin_recycle' => false,
            'use_buildin_filter'  => true,
            'orderBy'             => 'notify_id DESC',
            'actions'             => $actions,
        );
        
        $this->finder('monitor_mdl_event_notify', $params);
    }
    
    public function batchSend($notify_id = '')
    {
        if ($notify_id) {
            $_POST['notify_id'][] = $notify_id;
        }
        
        if (!$_POST['notify_id']) {
            die('暂不支持全选');
        }
        
        $this->pagedata['GroupList']   = json_encode($_POST['notify_id']);
        $this->pagedata['request_url'] = 'index.php?app=monitor&ctl=admin_alarm_notify&act=doBatchSend';
        
        parent::dialog_batch();
    }
    
    function doBatchSend()
    {
        $primary_id = explode(',', $_POST['primary_id']);
        if (!$primary_id) {
            echo 'Error: 请先选择重试数据';
            exit;
        }
        
        $retArr = array(
            'itotal'  => count($primary_id),
            'isucc'   => 0,
            'ifail'   => 0,
            'err_msg' => array(),
        );
        
        foreach ($primary_id as $id) {
            $param = array('notify_id' => $id, 'is_retry' => true);
            $msg   = '';
            $rs    = kernel::single('monitor_autotask_timer_sendnotify')->process($param, $msg);
            if ($rs) {
                $retArr['isucc']++;
            } else {
                $retArr['ifail']++;
                $retArr['err_msg'][] = $msg;
            }
        }
        
        echo json_encode($retArr), 'ok.';
        exit;
    }
}
