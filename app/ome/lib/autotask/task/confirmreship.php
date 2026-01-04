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


class ome_autotask_task_confirmreship
{
    function __construct($app)
    {
        $this->app = $app;
        $this->db = kernel::database();
    }

    /**
     * @description 执行批量自动审核
     * @access public
     * @param void
     * @return void
     */
    public function process($params, &$error_msg='') 
    {
        set_time_limit(180);
        
        // 简单防止一下并发
        usleep(rand(1, 1000000));
        
        $log_id = $params['log_id'];
        if(!$log_id || empty($params['log_text'])){
            return false;
        }
        
        $logiNoList = unserialize($params['log_text']);
        if (empty($logiNoList) || !is_array($logiNoList)){
            return false;
        }
        
        $reshipLib = kernel::single('ome_reship');
        $deliBatchLog = $this->app->model('batch_log');
        $oOperation_log = app::get('ome')->model('operation_log');
        
        //reship_id
        $logiNoList = array_filter($logiNoList);
        //$is_auto_approve = true; //只处理退货单
        
        #任务处理中
        $deliBatchLog->update(array('status'=>'2'), array('log_id'=>$log_id));
        
        //处理结果
        $result = array('total'=>0, 'succ'=>0, 'fail'=>0);
        
        //审批处理
        foreach ($logiNoList as $key => $val)
        {
            $result['total']++;
            
            $reship_id = intval($val);
            
            //执行审核
            $params = array('reship_id'=>$reship_id, 'status'=>'1', 'is_anti'=>false, 'exec_type'=>1);
            $confirm_error_msg = '';
            $confirm = $reshipLib->confirm_reship($params, $confirm_error_msg, $is_rollback);
            if(!$confirm){
                
                //log
                $memo = '系统自动审核失败: '. $confirm_error_msg;
                $oOperation_log->write_log('reship@ome', $reship_id, $memo);
                
                $result['fail']++;
                
                $error_msg .= $confirm_error_msg;
            }else{
                $result['succ']++;
            }
        }
        
        #任务已处理
        $fail = intval($result['fail']);
        $succ = intval($result['succ']);
        $deliBatchLog->update(array('status'=>'1', 'fail_number'=>$fail, 'succ_number'=>$succ), array('log_id'=>$log_id));
        
        return $result;
    }
    
    public function error($log_id,$logi_no,$msg,$failNum){
        
    }
    
    public function success($log_id,$logi_no,$succNum){
        
    }
}
