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

class logisticsmanager_ctl_admin_logistics_log extends desktop_controller{
    /**
     * index
     * @return mixed 返回值
     */
    public function index() {
        $base_filter = array('status|noequal'=>'success','channel_type'=>array('ems','360buy'));
        $params = array(
            'title'=>'物流回填异常日志',
            'actions'=>array(
                array('label' => '批量重试', 'submit' => 'index.php?app=logisticsmanager&ctl=admin_logistics_log&act=batch_retry','target' => 'dialog::{width:550,height:170,title:\'重试获取快递面单请求\'}'),
            ),
            'use_buildin_new_dialog' => false,
            'use_buildin_set_tag'=>false,
            'use_buildin_recycle'=>false,
            'use_buildin_export'=>false,
            'use_buildin_import'=>false,
            'base_filter' => $base_filter,
        );
        $this->finder('logisticsmanager_mdl_logistics_log', $params);
    }

    /**
     * batch_retry
     * @return mixed 返回值
     */
    public function batch_retry(){
        $this->pagedata['log_id'] = $_POST['log_id'];
        $this->pagedata['logCount'] = count($_POST['log_id']);
        $this->pagedata['jsonLogs'] = json_encode($_POST['log_id']);
        $this->display("admin/logistics/retryLog.html");
    }

    /**
     * ajaxRetry
     * @return mixed 返回值
     */
    public function ajaxRetry(){
        $tmp = explode('||', $_POST['ajaxParams']);
        $logs = explode(';', $tmp[1]);

        if(is_array($logs) && !empty($logs)){
            $channelObj = app::get("logisticsmanager")->model("channel");
            $logisticsLogObj = app::get('logisticsmanager')->model('logistics_log');
           

            
            //获取请求的日志信息
            $rows = $logisticsLogObj->getList('*',array('log_id'=>$logs));
            $succ = $fail = 0;
            foreach($rows as $val){
                if($val['params']) {
                    $channel_type = $val['channel_type'];
                    if(in_array($channel_type,array('ems','360buy'))) {

                        kernel::single('ome_event_trigger_logistics_electron')->delivery($val['delivery_id']);
                        
                    }
                    
                    $succ++;
                } else {
                    $fail++;
                }
                unset($val);
                usleep(200000);
            }
            unset($rows);
            echo json_encode(array('total' => count($logs), 'succ' => $succ, 'fail' => $fail));
        }else{
            echo json_encode(array('total' => 0, 'succ' => 0, 'fail' => 0));
        }
    }
}