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
 * 逻辑处理类DEMO
 * Class omecsv_split_import
 */
class omecsv_split_import implements omecsv_data_split_interface
{
    public function process($cursor_id, $params, &$errmsg)
    {
        @ini_set('memory_limit', '128M');
        $oFunc = kernel::single('omecsv_func');
    
        $oFunc->writelog('处理任务-开始', 'settlement', $params);
        //业务逻辑处理
        //任务数据统计更新等
        $oFunc->writelog('处理任务-完成', 'settlement', 'Done');
        return [true];
    }
    
    /**
     * 检查文件是否有效
     * @param $file_name 文件名
     * @param $file_type 文件类型
     * @return array
     * @date 2024-06-06 3:52 下午
     */
    public function checkFile($file_name, $file_type)
    {
        $ioType = kernel::single('omecsv_io_split_' . $file_type);
        $row    = $ioType->getData($file_name, 0, 5);
        //导入文件内容验证
        return array(true, '文件模板匹配', $row[1]);
    }
    
    /**
     * 导入文件表头定义
     * @date 2024-06-06 3:52 下午
     */
    public function getTitle($filter=null,$ioType='csv' )
    {
    }
    
    public function getConfig($key)
    {
    }
}