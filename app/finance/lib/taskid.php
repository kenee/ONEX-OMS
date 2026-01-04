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


class finance_taskid{

    /**
     * 存储任务号
     * @access public
     * @param String $taskid 任务号
     * @param dateTime $taskid_time 任务生成时间
     * @param String $node_id 节点ID
     * @param String  $node_name 节点名称
     * @param String  $start_time 开始时间
     * @param String  $end_time 结束时间
     * @return bool
     */
    public function save($task_id,$taskid_time='',$node_id='',$node_name='',$start_time='',$end_time=''){
        if (empty($task_id) || empty($node_id)) return false;

        $taskidModel = &app::get('finance')->model('taskid');
        $taskid_sdf = array(
            'task_id' => $task_id,
            'taskid_time' => $taskid_time ? $taskid_time : date('Y-m-d H:i:s',$time),
            'node_id' => $node_id,
            'node_name' => $node_name,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'createtime' => time(),
        );
        return $taskidModel->save($taskid_sdf);
    }

    /**
     * 获取任务号
     * @access public
     * @param Array $filter 过滤条件
     * @return bool
     */
    public function taskid_list($filter=array()){
        $taskidModel = &app::get('finance')->model('taskid');
        return $taskidModel->getList('*',$filter,0,-1);
    }

    /**
     * 删除任务号
     * @access public
     * @param String $task_id 任务号
     * @return bool
     */
    function delete($task_id){
        if (empty($task_id)) return true;

        $taskidModel = &app::get('finance')->model('taskid');
        $filter = array('task_id'=>$task_id);
        return $taskidModel->delete($filter);
    }

}