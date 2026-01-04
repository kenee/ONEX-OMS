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
 * 京东钱包流水导入queue队列任务
 *
 * @author wangbiao<wangbiao@shopex.cn>
 * @version $Id: Z
 */
class financebase_autotask_task_type_cainiaoAssignJdbill extends financebase_autotask_task_init
{
    /**
     * 处理
     * @param mixed $task_info task_info
     * @param mixed $error_msg error_msg
     * @return mixed 返回值
     */

    public function process($task_info, &$error_msg=null)
    {
        if(!is_dir(DATA_DIR.'/financebase/tmp_local')){
            utils::mkdir_p(DATA_DIR.'/financebase/tmp_local');
        }
        
        $oTask = kernel::single('financebase_data_task');
        $storageLib = kernel::single('taskmgr_interface_storage');
        
        $this->oFunc->writelog('京东钱包流水导入任务-开始','settlement','任务ID:'.$task_info['queue_id']);
        
        $remote_url = $task_info['queue_data']['remote_url'];
        $local_file = DATA_DIR.'/financebase/tmp_local/'.basename($remote_url);
        $file_type = $task_info['queue_data']['file_type'];
        $page_size = $this->oFunc->getConfig('page_size');
        
        $ioType = kernel::single('financebase_io_'.$file_type);
        $getfile_res = $storageLib->get($remote_url,$local_file);
        
        //切片任务
        list($status,$errmsg) = $oTask->_spliteCainiaoData($local_file,$file_type,$task_info['queue_data']['shop_id'],$task_info, $remote_url, 'cainiaojdbillimport');
        
        //删除文件&&清除task任务
        unlink($local_file);
        $storageLib->delete($remote_url);
        
        //return
        if($status){
            $this->oFunc->writelog('京东钱包流水分派任务-完成','settlement','任务ID:'.$task_info['queue_id']);
        }else{
            $error_msg[] = $errmsg; 
            $this->oFunc->writelog('京东钱包流水分派任务-失败','settlement','任务ID:'.$task_info['queue_id']);
            return false;
        }
        
        return true;
    }
}