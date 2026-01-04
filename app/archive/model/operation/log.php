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

class archive_mdl_operation_log extends dbeav_model{
    
    var $operations = array();
    
    
    /*
     * 写日志
     *
     * @param int $operation 操作标识
     * @param int $obj_id 操作对象id（主键ID）
     * @param string $memo 操作内容备注
     * @param int $operate_time 操作时间
     * @param string $opinfo 操作额外信息
     *
     * @return bool
     */
    function write_log($memo=NULL,$archive_time){
        
        //操作额外信息
        $opinfo = $this->_get_op_info($opinfo);
        $op_id = $opinfo['op_id'];#操作者ID
        $op_name = $opinfo['op_name'];#操作者姓名
        
        $title_column = $_operations['title_column'];
        $title_value = '归档操作';

        if ($memo){
            $ip = kernel::single("base_request")->get_remote_addr();
            $data = array(
              
             
               'op_id' => $op_id ? $op_id : 16777215,
               'op_name' => $op_name ? $op_name : '系统',
               'operate_time' => $operate_time ? $operate_time : time(),
               'memo' => $memo,
               'ip' => $ip
            );
            if ($archive_time>0) {
                $data['archive_time'] = $archive_time;
            }

            $this->save($data);
            return $data['log_id'];
        }else{
            return false;
        }
    }

   
    
    /**
     * 获取操作者信息
     * @param mixed $opinfo 操作人信息
     * @access private
     * @return ArrayObject
     */
    private function _get_op_info($opinfo=NULL){
        if ($opinfo){
            $_opinfo = $opinfo;
        }else {
            $_opinfo = kernel::single('ome_func')->getDesktopUser();
        }
        return $_opinfo;
    }
    
    
}
?>