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
 * 后台伪队列任务处理类
 *
 * @author kamisama.xia@gmail.com 
 * @version 0.1
 */

class ome_autotask_timer_queue
{
    public function process($params, &$error_msg=''){
        set_time_limit(0);
        ignore_user_abort(1);

        $queue_id = intval($params['queue_id']);
        $params['params'] = unserialize($params['params']);
        $now = time();
        $queueModel = app::get('base')->model('queue');

        if($params['runkey']){
            $runkey = $params['runkey'];
            $queueModel->db->exec('update sdb_base_queue set status="running",worker_active='.$now.'
                where queue_id='.intval($queue_id).' and runkey='.$queueModel->db->quote($runkey)); 
        }else{
            $runkey = md5(microtime().rand(0,9999));
            $queueModel->db->exec('update sdb_base_queue set status="running",runkey="'.$runkey.'",worker_active='.$now.'
                where queue_id='.intval($queue_id).' and (status="hibernate" 
                or (status="running" and worker_active<'.($now-$queueModel->task_timeout).'))');
        }

        if($queueModel->db->affect_row()){
            if(empty($params['worker'])) {
                $params = $queueModel->dump(array('queue_id'=>$queue_id));
            }
            list($worker,$method) = explode('.',$params['worker']);
            $errmsg = null;
			$obj_work = kernel::single($worker);

            try{
                call_user_func_array( array(  $obj_work ,$method),array(&$params['cursor_id'],$params['params'], &$errmsg));
            } catch (Exception $e) {
                $errmsg = $e->getMessage();
                if(isset($errmsg[250])) {
                    $errmsg = '队列任务执行异常';
                }
            }

            //调整原来框架未实现部分，不支持重试机制
            if(is_null($errmsg)){
                $queueModel->db->exec('delete from sdb_base_queue where queue_id='.intval($queue_id));
            }else{
                $queueModel->db->exec('update sdb_base_queue set status="failure",errmsg='.$queueModel->db->quote(mb_strcut($errmsg, 0, 200, 'utf-8')).' where queue_id='.intval($queue_id));    //todo:如果有错误信息
            }
        }

        return true;
    }
}