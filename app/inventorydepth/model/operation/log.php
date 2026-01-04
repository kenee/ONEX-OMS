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
 *
 * @category inventorydepth
 * @package model/operation
 * @author chenping<chenping@shopex.cn>
 * @version $Id: log.php 2013-11-20 14:57 Z
 */
class inventorydepth_mdl_operation_log extends dbeav_model
{
    private $operation = array(
        'stockup' => '库存回写',
        'stockset' => '库存回写设置',
        'approve' => '上下架',
        'task'      =>'活动库存回写设置',
        'supply_branches_set'      =>'供应仓设置',
        'online_offline_set'       =>'云店门店设置',
        'edit' => '编辑',
    );

    public function get_operation_name($operation)
    {
        return $this->operation[$operation];
    }

    /**
     * 写操作日志
     *
     * @param String $obj_type 对象类型
     * @param String $obj_id   对象ID
     * @param String $operation 日志行为
     * @param String $memo  日志说明
     * @param Array $oper 操作人信息
     * @return void
     * @author
     **/
    public function write_log($obj_type,$obj_id,$operation,$memo,$oper=array())
    {
        $operInfo = $oper ? $oper : kernel::single('inventorydepth_func')->getDesktopUser();

        $optLog = array(
            'obj_type'    => $obj_type,
            'obj_id'      => $obj_id,
            'memo'        => $memo,
            'create_time' => time(),
            'op_id'       => $operInfo['op_id'],
            'op_name'     => $operInfo['op_name'] ? $operInfo['op_name'] : $operInfo['login_name'],
            'operation'   => $operation,
        );

        return $this->insert($optLog);
    }

    /**
     * 写操作日志
     *
     * @param String $obj_type 对象类型
     * @param String $obj_id   对象ID集合
     * @param String $operation 日志行为
     * @param String $memo  日志说明
     * @param Array $oper 操作人信息
     * @return void
     * @author
     **/
    public function batch_write_logs($obj_type,$obj_ids,$operation,$memo,$oper=array())
    {
        if(empty($obj_ids)) {
            return false;
        }
        $operInfo = $oper ? $oper : kernel::single('inventorydepth_func')->getDesktopUser();

        $optLogs = array();
        foreach ($obj_ids as $obj_id) {
            $optLogs[] = array(
                'obj_type'    => $obj_type,
                'obj_id'      => $obj_id,
                'memo'        => $memo,
                'create_time' => time(),
                'op_id'       => $operInfo['op_id'],
                'op_name'     => $operInfo['op_name'] ? $operInfo['op_name'] : $operInfo['login_name'],
                'operation'   => $operation,
            );
        }

        $sql = kernel::single('inventorydepth_func')->get_insert_sql($this,$optLogs);

        return $this->db->exec($sql);
    }
}
