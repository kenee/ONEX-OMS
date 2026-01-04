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
 * 队列处理
 * Class omecsv_autotask_task_process
 */

class omecsv_autotask_task_process extends omecsv_autotask_task_init
{
    public function process($params, &$error_msg='')
    {
        set_time_limit(0);
        ignore_user_abort(1);
        @ini_set('memory_limit','512M');
        
        $filter = array();
        $params['queue_id'] and $filter['queue_id'] = $params['queue_id'];
        $filter['status'] = 'ready';
        
        // 获取检测任务
        $task_info = $this->oQueue->getList('queue_id,queue_name,queue_mode,queue_data,queue_no,bill_type,remote_url',$filter,0,1);
        if($task_info){
            $task_info = $task_info[0];
            $task_info['queue_data'] = json_decode($task_info['queue_data'],true);
            
            $class_name = sprintf("omecsv_autotask_task_type_".$task_info['queue_mode']);
            
            if (ome_func::class_exists($class_name) && $instance = kernel::single($class_name)){
                if (method_exists($instance,'process')){
                    $this->oQueue->update(array('status'=>'process','modify_time'=>time()),array('queue_id'=>$task_info['queue_id']));
                    $rs = $instance->process($task_info,$msg);
                    if($rs){
                        $this->oQueue->update(array('status'=>'succ','modify_time'=>time()),array('queue_id'=>$task_info['queue_id']));
                    }else{
                        $status = $task_info['queue_mode'] == 'assign' ? 'error' : 'partsucc';
                        $this->oQueue->update(array('status'=>$status,'modify_time'=>time(),'error_msg'=>$msg),array('queue_id'=>$task_info['queue_id']));
                    }
                }else{
                    $this->oFunc->writelog('导入任务-处理方法不存在','settlement','任务ID:'.$task_info['queue_no']);
                    $this->oQueue->update(array('status'=>'error','modify_time'=>time(),'error_msg'=>array('处理方法不存在')),array('queue_id'=>$task_info['queue_id']));
                }
            }else{
                $this->oFunc->writelog('导入任务-处理类不存在','settlement','任务ID:'.$task_info['queue_no']);
                $this->oQueue->delete(array('status'=>'error','modify_time'=>time(),'error_msg'=>array('处理方法不存在')),array('queue_id'=>$task_info['queue_id']));
            }
        }
        
        return true;
        
    }
    
    
    
}