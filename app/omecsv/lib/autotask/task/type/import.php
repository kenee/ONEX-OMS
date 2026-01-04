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
 * 导入处理任务
 * Class omecsv_autotask_task_type_import
 */
class omecsv_autotask_task_type_import extends omecsv_autotask_task_init
{
    
    public function process($task_info, &$error_msg)
    {
        $this->oFunc->writelog('导入任务-开始', 'settlement', '任务ID:' . $task_info['queue_no']);
        
        $storageLib                      = kernel::single('taskmgr_interface_storage');
        $remote_url                      = $task_info['remote_url'];
        $local_file                      = DATA_DIR . '/omecsv/tmp_local/' . basename($remote_url);
        $getfile_res                     = $storageLib->get($remote_url, $local_file);
        if (!is_bool($getfile_res)) {
            $local_file = $getfile_res;
        }
        $task_info['queue_data']['data'] = array();
        if ($getfile_res) {
            $task_info['queue_data']['data'] = json_decode(file_get_contents($local_file), 1);
        }
        
        //获取白名单配置类
        $billType = kernel::single('omecsv_split_whitelist')->getBillType($task_info['queue_data']['type']);
        $o        = kernel::single($billType['class']);
        
        $errmsg = array();
        $o->process($task_info['queue_id'], $task_info['queue_data'], $errmsg);
        
        unlink($local_file);
        $storageLib->delete($remote_url);
        
        if ($errmsg) {
            $error_msg = $errmsg;
            $this->oFunc->writelog('导入任务-部分成功', 'settlement', '任务ID:' . $task_info['queue_no']);
            return false;
        } else {
            $this->oFunc->writelog('导入任务-完成', 'settlement', '任务ID:' . $task_info['queue_no']);
        }
        
        return true;
    }
}